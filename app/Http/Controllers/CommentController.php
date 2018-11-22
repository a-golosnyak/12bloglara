<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;

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

    public function editComment(Request $request)
    {
        $this->validate($request, [
            'id' => 'required',
            'body' => 'required|max:1000'       
        ]);

        $id = $request->input('id');

        $comment = new Comment();
        $comment = Comment::where('id', $id)->get();
        
        if(Auth::user()->name == $comment[0]->user->name)
        {
            $comment->id = $request->input('id');
            $comment->body = $request->input('body');

            Comment::where('id', $comment->id)->update([
                            'id' => $comment->id,
                            'body'=> $comment->body]);

            return response("$comment->id" . " " . "$comment->body", 200)
                  ->header('Content-Type', 'text/plain');
        }
        else
        {
            return response('err', 403)
                  ->header('Content-Type', 'text/plain');
        }   
    }

    public function delComment(Request $request)
    {
        $this->validate($request, [
            'id' => 'required'
        ]);

        $id = $request->input('id');

        $comment = Comment::where('id', $id)->get();

        if(Auth::user()->name == $comment[0]->user->name)
        {
            $comment = Comment::where('id', $id)->delete();

            return response('ok', 200)
                  ->header('Content-Type', 'text/plain');
        }
        else
        {
            return response('err', 403)
                  ->header('Content-Type', 'text/plain');
        }
    }
}
