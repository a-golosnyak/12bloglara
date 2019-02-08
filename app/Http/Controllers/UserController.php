<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;
use Illuminate\Support\Facades\Auth;
use Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkauth', ['only' => ['getUser', 'setname', 'setemail', 'setpassword']]);
//        $this->middleware('checkuser', ['only' => ['setname', 'setemail', 'setpassword']]);
    }

    public function getUser($id)
    {
        $user = User::where('id', $id)->get();
        $categories = Category::pluck('name', 'id');

        if (Auth::user()->email == $user[0]->email) {
            return view('profile', [	'user'=>$user[0],
                                    'categories' => $categories]);
        } else {
            abort(403);
        }
    }

    public function checkUser(Request $request)
    {
        $this->validate($request, [
            'email' => 'required'
        ]);

        $user = User::where('email', $request->input('email'))->count();

        if ($user > 0) {
            return response('exists', 200)
                      ->header('Content-Type', 'text/plain');
        } else {
            return response('absent', 200)
                  ->header('Content-Type', 'text/plain');
        }
    }

    //-------------------------------------------------------------------------------------------
    //		Настроять ограничения для валидации получаемых значений. Будем это делать на сервере.
    //-------------------------------------------------------------------------------------------
    public function setName(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3'
        ]);

        $name = $request->input('name');

        User::where('id', Auth::user()->id)
                ->update(['name'=>$name]);

        return redirect("/profile/". Auth::user()->id)->with('status', 'Имя пользователя обновлено.');
    }

    public function setEmail(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email'
        ]);

        $email = $request->input('email');

        $file = "images/ava/" . Auth::user()->email . ".jpeg";
        $newFile = "images/ava/$email.jpeg";

        if (copy($file, $newFile)) {          // Делаем копию файла
            $status = "Email обновлен.";
        } else {
            $status = "Не удалось пересохранить картинку. Email не обновлен.";
        }

        User::where('id', Auth::user()->id)
                ->update(['email'=>$email]);

        if (copy($file, $newFile)) {          // Делаем копию файла
            return redirect("/profile/". Auth::user()->id)->with('status', $status);
        } else {
            return redirect("/profile/". Auth::user()->id)->with('error', $status);
        }
    }

    /*
        111111 - $2y$10$q4EduJT49Qwm2WloHYB9T.4NyrJdZWMqURTmX3.axIeyz7Kl0GH4i
    
    */
    public function setPassword(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|min:6',
            'password_confirm' => 'required|min:6'
        ]);

        $password = $request->input('password');
        $password_confirm = $request->input('password_confirm');

        if (strcmp($password, $password_confirm) == 0) {
            $password = Hash::make($password);

            User::where('id', Auth::user()->id)
                ->update(['password'=>$password]);

            return redirect("/profile/". Auth::user()->id)->with('status', "Пароль обновлен.");
        } else {
            return redirect("/profile/". Auth::user()->id)->with('error', 'Введенные пароли не совпадают.');
        }
    }

    public function setImage(Request $request)
    {
        $this->validate($request, [
            'ava_image' => 'required'
        ]);

        if ($request->file('ava_image')->isValid()) {
            $imageName = '../images/ava/'. Auth::user()->email . '.' . 'jpeg';
            $request->ava_image->move(public_path('images/ava'), $imageName);

            return response('ok', 200)->header('Content-Type', 'text/plain');
        }
        return response('error', 200)->header('Content-Type', 'text/plain');
    }
}
