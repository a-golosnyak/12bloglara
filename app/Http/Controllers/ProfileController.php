<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Category;

class ProfileController extends Controller
{
	public function getUser($id)
	{
		$user = User::where('id', $id)->get();
		$categories = Category::pluck('name', 'id');

	    return view('profile', 	[	'user'=>$user[0],
									'categories' => $categories] );
	}

	public function checkUser(Request $request)
	{
	    $this->validate($request, [
            'email' => 'required'
        ]);

        $email = $request->input('email');
        $user = User::where('email', $email)->get();

	//	$user = User::where('email', '=', Input::get('email'))->first();

		return response($user, 200)
	                  ->header('Content-Type', 'text/plain');

/*		if ($user === null) {
			return response('absent', 200)
                  ->header('Content-Type', 'text/plain');
		}
		
		return response('exists', 200)
	                  ->header('Content-Type', 'text/plain');
*/
	}
}
