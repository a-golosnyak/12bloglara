<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Comment;
use App\Post;

class CommentController extends Controller
{
      public function submit(Request $request)
    {
        $categories = Category::pluck('name', 'id');    

        $this->validate($request, [
            'body' => 'required|max:1000',
            'post_id' => 'required',
            'user_id' => 'required',
            'parent_comment_id' => 'required'          
        ]);

		$comment = new Comment();
		$comment->post_id = $request->input('post_id');
		$comment->user_id = $request->input('user_id');
		$comment->parent_comment_id = $request->input('parent_comment_id');
		$comment->body = $request->input('body');
		$comment->save();
/*
        echo "<pre>";
        print_r($comment);
        echo "</pre>";
*/
        return redirect("/$comment->post_id")->with('status', 'Комментарий добавлен');
    }
}
