<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use DB;
use App\Post;
use App\User;
use App\Comment;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller 
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function contacts()
    {
        $categories = Category::pluck('name', 'id');

        return view('contacts', ['categories' => $categories]);
    }

    public function aboutSite()
    {
        $categories = Category::pluck('name', 'id');

        return view('about', ['categories' => $categories]);
    }

    public function getPosts($id=0)
    {
        $categories = Category::pluck('name', 'id');

        if($id == 0)
          	$posts = Post::orderBy('created_at', 'desc')->paginate(7);
        else
            $posts = Post::where('category_id', $id)->orderBy('created_at', 'desc')->paginate(7);

//		echo $id;
/*        echo "<pre>";
        print_r($posts);
        echo "</pre>";		
*/
        return view('home', [   'categories' => $categories,
                                'posts' => $posts]);                             
    }

    public function getPostsOfUser($id=0)
    {
        $categories = Category::pluck('name', 'id');
        $posts = Post::where('user_id', $id)->orderBy('id', 'desc')->paginate(7);
        
        return view('home', [   'categories' => $categories,
                                'posts' => $posts]);                              
    }

    public function getPost($id)
    {
        $categories = Category::pluck('name', 'id');
        $posts = Post::where('id', $id)->get();
        $comments = Comment::where('post_id', $id)->where('parent_comment_id', 0)->orderBy('created_at', 'desc')->get();
        
        $nested_comments = null;
        foreach ($comments as $comment) {
            $nested_comments[$comment->id][] = Comment::where('parent_comment_id', $comment->id)->get();
        }

        return view('article', [   'categories' => $categories,
                                    'post' => $posts[0],
                                    'comments' => $comments,
                                    'nested_comments' => $nested_comments]);    
    }

    public function addPost()
    {
		$categories = Category::pluck('name', 'id');	
		
    	return view('addpost', ['categories' => $categories,
                                'post_id'=>'',
                                'action'=>'/addpost/submit',
                                'post_title' =>'',
                                'post_intro' =>'',
                                'image' =>'',
                                'body' =>'']);
    }

    public function editPost($id)
    { 
        $categories = Category::pluck('name', 'id'); 
        $posts = Post::where('id', $id)->get();   

        if(Auth::user()->email == $posts[0]->user->email)
        {
            return view('addpost', ['categories' => $categories,
                                    'post_id'=>$id,
                                    'action'=>"/addpost/update",
                                    'post_title' => $posts[0]->title,
                                    'post_intro' => $posts[0]->intro,
                                    'image' => $posts[0]->img,
                                    'body' => $posts[0]->body]);
        }
        else
        {
            abort(403);
        }
    }

    public function updatePost(Request $request)
    {
//        $categories = Category::pluck('name', 'id');                  // ???
        
        $this->validate($request, [
            'id'=>'required',
            'author' => 'required',
            'category' => 'required',
            'post_title' => 'required|max:220',
            'post_intro' => 'required|max:1200',
            'post_image' => 'max:10000',
            'post_body' => 'required'            
        ]);

        $post = new Post();
        $post->id = $request->input('id');
        $post->user_id = $request->input('author');
        $post->category_id = $request->input('category');
        $post->title = $request->input('post_title');   
        $post->intro = $request->input('post_intro'); 
        $post->body  = $request->input('post_body');

        $posts = Post::where('id', $post->id)->get(); 

        if(Auth::user()->email == $posts[0]->user->email)
        {
            if ($request->hasFile('post_image')) 
            {
                $path = $request->post_image->path();
                $art_title_trnslt = self::translit($request->input('post_title'));
                $tmp = substr($art_title_trnslt, 0, 5);                             // substr делает ошибку с кирилическим текстом.
                $imageName = '../images/posts/'. 
                            date("Y-m-d_His") .'_'. 
                            $tmp .'_'. mt_rand(0, 1000) . '.' .
                            $request->post_image->getClientOriginalExtension();
                $request->post_image->move(public_path('images/posts'), $imageName);
                $post->img = $imageName;

                Post::where('id', $post->id)
                ->update(['user_id'     =>$post->user_id,
                        'category_id'   =>$post->category_id,
                        'title'         =>$post->title,
                        'intro'         =>$post->intro,
                        'img'           =>$post->img, 
                        'body'          =>$post->body]);

                return redirect("/$post->id")->with('status', 'Пост обновлен.');
            }
            else
            {
                Post::where('id', $post->id)
                ->update(['user_id'     =>$post->user_id,
                        'category_id'   =>$post->category_id,
                        'title'         =>$post->title,
                        'intro'         =>$post->intro,
                        'body'          =>$post->body]);

                return redirect("/$post->id")->with('status', 'Пост обновлен. Картинка - нет.');
            }
        }
        else
        {
            abort(403);
        }
    }

    public function deletePost($id)
    {
        $posts = Post::where('id', $id)->get();

        if(Auth::user()->email == $posts[0]->user->email)
        {
            $posts = Post::where('id', $id)->delete();
            return redirect("/")->with('status', 'Пост удален.');
        }
        else
        {
            abort(403);
        }
    }

    public function submit(Request $request)
    {
//        $categories = Category::pluck('name', 'id');    
        
        $this->validate($request, [
            'author' => 'required',
            'category' => 'required',
            'post_title' => 'required|max:220',
            'post_intro' => 'required|max:1200',
            'post_image' => 'required',
            'post_body' => 'required'            
        ]);

        if ($request->file('post_image')->isValid()) {
            $path = $request->post_image->path();
            $art_title_trnslt = self::translit($request->input('post_title'));
            $tmp = substr($art_title_trnslt, 0, 5);                             // substr делает ошибку с кирилическим текстом.
            $imageName = '../images/posts/'. 
                            date("Y-m-d_His") .'_'. 
                            $tmp .'_'. mt_rand(0, 1000) . '.' .
                            $request->post_image->getClientOriginalExtension();
            $request->post_image->move(public_path('images/posts'), $imageName);
        }
        else{
            return redirect("/")->with('error', 'Картинка не распознана.');
        }

        $post = new Post();
        $post->user_id = $request->input('author');
        $post->category_id = $request->input('category');
        $post->title = $request->input('post_title');
        $post->img = $imageName;
        $post->intro = $request->input('post_intro'); 
        $post->body  = $request->input('post_body'); 
        $post->save();

        return redirect("/")->with('status', 'Пост получен и готовится к публикации.');
    }


    function translit($str) 
    {
        $rus = array('А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я', ' ');
        $lat = array('A', 'B', 'V', 'G', 'D', 'E', 'E', 'Gh', 'Z', 'I', 'Y', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'C', 'Ch', 'Sh', 'Sch', 'Y', 'Y', 'Y', 'E', 'Yu', 'Ya', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'gh', 'z', 'i', 'y', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'ch', 'sh', 'sch', 'y', 'y', 'y', 'e', 'yu', 'ya', '_');
        return str_replace($rus, $lat, $str);
    }

}








/*        
        echo "<pre>";
        foreach ($comments as $comment) {
            foreach($nested_comments[$comment->id] as $nested_comment){            
                foreach ($nested_comment as $var) {
                    echo $var->id;
                    echo "<br>" ;
                }
            }
        }   
        echo "</pre>";  





*/










