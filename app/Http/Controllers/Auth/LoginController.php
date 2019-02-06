<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except(['logout', 'redirectToProvider']);
    }

    protected function validatorSocials(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'string|min:6',
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
            'password' => Hash::make($data['password'])
        ]);
    }

    /****************************************************************************************
    * Вход через GitHub.
    *
    * @return Response
    ****************************************************************************************/
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
    * Получение информации о пользователе от GitHub.
    *
    * @return Response
    */
    public function handleProviderCallback($provider)
    {
        $user = Socialite::driver($provider)->user();

        $authUser = User::where('email', $user->email)->first();

        if ($authUser) {
            $user = $authUser;
        } else {
            if ($user->name == 0) {
                $name = preg_split("/@/", $user->email);
                $user->name = $name[0];
            }

            //--- Profile image ---------------------------------------------------------
            $file = "images/ava/Guest.jpg";
            $newFile = "images/ava/$user->email.jpeg";

            if (copy($file, $newFile)) {          // Делаем копию файла
                $status = "Ok";
            } else {
                $status = "err01";
            }
            //---------------------------------------------------------------------------

            $user = User::create([
                'name'     => $user->name,
                'email'    => $user->email,
                'provider' => $provider,
                'provider_id' => $user->id
            ]);
        }

        Auth::login($user, true);
        return redirect($this->redirectTo);
    }
}











/*

        echo "<pre>";
            var_dump($user);
        echo "</pre>";


            //--- Dubug -----------------------------------------------------------------
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


            */
