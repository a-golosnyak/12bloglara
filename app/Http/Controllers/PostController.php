<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;

class PostController extends Controller
{
    public function addPost()
    {
		$category = Category::all();
//		$category = DB::select("SELECT * FROM categories");
    	
    	return view('addpost', ['category' => $category]);
    }

    public function editPost()
    {
    	
    }

}
