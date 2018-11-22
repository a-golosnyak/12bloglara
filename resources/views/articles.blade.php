<div class='col-md-8 blog-main '>
    <div class='blog-post'>  
        <div class='container-fluid' >
            @foreach ($posts as $post)    
                <a class=' none-decored' href='/{{$post->id}}'>
                    <h2 class='blog-post-title'>{{ $post->title }}</h2>
                </a>
                <p class='blog-post-meta'>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d H:i') }} автор {{ $post->user->name }}<a class='none-decored' href='#'></a>
                </p>
                <div style='display: none;'>{{ $post->art_id }}</div>
                <p>{{ $post->intro }}</p>
                <p><img class='post-preview-img' src={{ $post->img }}></p>
                <br>
                <div class='post-footer'>
                    <a href="/{{$post->id}}" class="float-left"><button class="comment-btn">Читать далее...</button></a>
                {{--    @guest
                    @else
                        @if (Auth::user()->name == $post->user->name)
                        <a href="/delete/{{$post->id}}" class="float-left"><button class="comment-btn">Изменить</button></a>
                        <a href="/delpost/{{$post->id}}" class="float-left"><button class="comment-btn">Удалить</button></a>
                        @endif
                    @endguest   --}}
                    <a href='/{{$post->id}}#commentAnchor' class='cursor-pointer none-decored float-right mr-2'>
                        <div class='comments-link'>Комментарии</div>
                    </a>
                </div>
                <br style='clear: both;'>
                <hr>
                <br>
                <br>
            @endforeach
            {{ $posts->links() }}
        </div>
    </div>
</div>

