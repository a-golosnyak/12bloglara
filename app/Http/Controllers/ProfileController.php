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
}
