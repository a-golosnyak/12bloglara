<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Socialite;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'auth_via' => $data['auth_via'],
            'social_id' => $data['social_id'],
        ]);
    }

    public function reg()
    {
        $categories = Category::pluck('name', 'id');

        return view('registration', ['categories' => $categories]);
    }

    /**
     * Handle a registration request for the application. REDEFINED method !!!!
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        
        echo "<pre>";
        var_dump($request->all());
        echo "</pre>";

    //    while(1) {;}

        /*        $user->auth_via = ;
                $user->auth_via = ;
        */
        event(new Registered($user = $this->create($request->all())));

        $file = "images/ava/Guest.jpg";
        $newFile = "images/ava/$user->email.jpeg";

        //--- Присваеваем новому профилю стандартную картпинку --------------------------------
        if (copy($file, $newFile)) {          // Делаем копию файла
            $status = "Ok";
        } else {
            $status = "err01";
        }

        $this->guard()->login($user);

    //    return $this->registered($request, $user)
    //                    ?: redirect($this->redirectPath());
    }

    /**
    * Получение информации о пользователе от GitHub.
    *
    * @return Response
    */
    public function handleProviderCallback()
    {
        $newUser = Socialite::driver('github')->user();

        $user = new User();
        $user->name = $newUser->getNickname();
        $user->email = $newUser->getEmail();
        $user->password = '111111';

        /*        echo "<pre>";
                var_dump($newUser);
                echo "</pre>";
        */
        $file="devlog.txt";
        if (!$handle = fopen($file, 'a')) {
            echo "Не могу открыть файл ($flename)";
            exit;
        }
        $output = $user->name . "\r\n" . $user->email . "\r\n" . $user->password . "\r\n" ."\r\n";
        if (fwrite($handle, $output) === false) {
            echo "Не могу произвести запись в файл ($file)";
            exit;
        }

        event(new Registered($user));

        $file = "images/ava/Guest.jpg";
        $newFile = "images/ava/$user->email.jpeg";

        if (copy($file, $newFile)) {          // Делаем копию файла
            $status = "Ok";
        } else {
            $status = "err01";
        }

        $userArray['name'] = $user->name;
        $userArray['email'] = $user->email;
        $userArray['password'] = $user->password;
        $userArray['auth_via'] = ' ';
        $userArray['social_id'] = ' ';
/*
        echo "<pre>";
        var_dump($newUser);
        echo "</pre>";       
*/
        $this->guard()->login($user = $this->create($userArray));
        
        return redirect("/")->with('message', 'asd');

        echo "asddffgds";
    }

    public function object_to_array($data)
    {
        if (is_array($data) || is_object($data)) {
            $result = array();
            foreach ($data as $key => $value) {
                $result[$key] = $this->object_to_array($value);
            }
            return $result;
        }
        return $data;
    }
}
