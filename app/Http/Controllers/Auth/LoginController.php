<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Socialite;
use App\User;
use Validator;
use Illuminate\Auth\Events\Registered;
use Hash;
use Illuminate\Http\Request;

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

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLoginSocials(array $user)
    {
        $validator = Validator::make($user, [
            $this->username() => 'required|string',
            'password' => 'required|string',
        ]);
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
    * Переадресация пользователя на страницу аутентификации Facebook.
    *
    * @return Response
    *****************************************************************************************/
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    /**
    * Вход через Facebook.
    *
    * @return Response
    */
    public function handleFacebookCallback(Request $request)
    {
        $newUser = Socialite::driver('facebook')->user();

        $user = new User();
        $user->name = $newUser->getNickname();
        $user->email = $newUser->getEmail();
        $user->password = "facebook_" . $newUser->getId();

        return $this->getUserLoggedIn($request, $user);
    }

    /***************************************************************************************
    * Переадресация пользователя на страницу аутентификации LinkedIn.
    *
    * @return Response
    ****************************************************************************************/
    public function redirectToLinkedIn()
    {
        return Socialite::driver('linkedin')->redirect();
    }

    /**
    * Вход через LinkedIn.
    *
    * @return Response
    */
    public function handleLinkedInCallback(Request $request)
    {
        $newUser = Socialite::driver('linkedin')->user();

        $user = new User();
        $user->name = $newUser->getName();
        $user->email = $newUser->getEmail();
        $user->password = "linkedin_" . $newUser->getId();

        return $this->getUserLoggedIn($request, $user);
    }

    /****************************************************************************************
    * Вход через GitHub.
    *
    * @return Response
    ****************************************************************************************/
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
    * Получение информации о пользователе от GitHub.
    *
    * @return Response
    */
    public function handleGithubCallback(Request $request)
    {
        $newUser = Socialite::driver('github')->user();

        $user = new User();
        $user->name = $newUser->getNickname();
        $user->email = $newUser->getEmail();
        $user->password = "github_" . $newUser->getId();

        return $this->getUserLoggedIn($request, $user);
    }
    /**
    * Работа по пользователю. Регистрация или вход.
    *
    * @return Response
    */
    public function getUserLoggedIn(Request $request, User $user)
    {
        $userArray['name'] = $user->name;
        $userArray['email'] = $user->email;
        $userArray['password'] = $user->password;

        $this->validateLoginSocials($userArray);
        $retval = $this->guard()->attempt(['email'=>$user->email, 'password'=>$user->password], true);
        
        if ($retval) {
            return $this->sendLoginResponse($request);
        } else {
            $this->validatorSocials($userArray)->validate();
            event(new Registered($user = $this->create($userArray)));

            //--- Profile image ---------------------------------------------------------
            $file = "images/ava/Guest.jpg";
            $newFile = "images/ava/$user->email.jpeg";

            if (copy($file, $newFile)) {          // Делаем копию файла
                $status = "Ok";
            } else {
                $status = "err01";
            }
            //---------------------------------------------------------------------------
        
            $this->guard()->login($user);
            return redirect($this->redirectPath());
        }
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