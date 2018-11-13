<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
use App\Post;

class PostController extends Controller
{
    public function getPosts()
    {
        $categories = Category::pluck('name', 'id');
        $posts = Post::all();
/*
        echo "<pre>";
        echo "asd";
        print_r($posts);
        echo "</pre>";
*/
        return view('home', [   'categories' => $categories,
                                'posts' => $posts]);
    }


    public function addPost()
    {
		$categories = Category::pluck('name', 'id');	
		
    	return view('addpost', ['categories' => $categories]);
    }

    public function editPost()
    {
    	
    }

}
