<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
use App\Post;
use App\User;

class PostController extends Controller
{
    public function getPosts()
    {
        $categories = Category::pluck('name', 'id');
      	$posts = Post::orderBy('id', 'desc')->get();

//		echo $posts[0]->user->name;
/*      echo "<pre>";
        print_r($posts);
        echo "</pre>";		*/

        return view('home', [   'categories' => $categories,
                                'posts' => $posts]);
  
    }

    public function getPost($id)
    {
        $categories = Category::pluck('name', 'id');
        $posts = Post::where('id', $id)->get();

        return view('article', [   'categories' => $categories,
                                    'post' => $posts[0]]);
  
    }



    public function addPost()
    {
		$categories = Category::pluck('name', 'id');	
		
    	return view('addpost', ['categories' => $categories]);
    }

    public function submit(Request $request)
    {
        $categories = Category::pluck('name', 'id');    

        $this->validate($request, [
            'author' => 'required',
            'category' => 'required',
            'post_title' => 'required|max:220',
            'post_intro' => 'required|max:1200',
            'image' => 'required',
            'post-body' => 'required'            
        ]);

        if ($request->file('image')->isValid()) {
            $path = $request->image->path();
            echo "<pre>";
            echo "$path";
            echo "</pre>";
            $art_title_trnslt = self::translit($request->input('post_title'));
            $tmp = substr($art_title_trnslt, 0, 5);     // substr делает ошибку с кирилическим текстом.
            $imageName = '../images/posts/'. 
                            date("Y-m-d_His") .'_'. 
                            $tmp .'_'. mt_rand(0, 1000) . '.' .
                            $request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/posts'), $imageName);
        }
        else{
            echo 'File invalid';
        }

        $post = new Post();
        $post->user_id = $request->input('author');
        $post->category_id = $request->input('category');
        $post->title = $request->input('post_title');
        $post->img = $imageName;
        $post->intro = $request->input('post_intro');
        $post->body  = $request->input('post-body');  

        $post->save();

        return redirect("/")->with('status', 'Пост получен и готовится к публикации.');
    }


    public function editPost()
    {
    	
    }

    function translit($str) 
    {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya');
        return str_replace($rus, $lat, $str);
    }

}
