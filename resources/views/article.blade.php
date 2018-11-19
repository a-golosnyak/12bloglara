@extends('layouts.main')


@section('content')
    <div class='col-md-8 blog-main '>
        <div class='blog-post'>  
            <div class='container-fluid' >   
                <a class=' none-decored' href=''>
                    <h2 class='blog-post-title'>{{ $post->title }}</h2>
                </a>
                <p class='blog-post-meta'>{{ \Carbon\Carbon::parse($post->created_at)->format('Y-m-d H:i') }} автор {{ $post->user->name }}<a class='none-decored' href='#'></a>
                </p>
                <div style='display: none;'>{{ $post->art_id }}</div>
                <p>{{ $post->intro }}</p>
                <p><img class='post-preview-img' src={{ $post->img }}></p>        
                <p>{!! $post->body !!}</p>
                <br>
                <br>
                @guest
                @else
                    @if (Auth::user()->name == $post->user->name)
                    <a href='/addpost/{{$post->id}}'><button class="comment-btn pull-xs-right">Изменить</button></a>
                    <a href="/delpost/{{$post->id}}"><button class="comment-btn pull-xs-right">Удалить</button></a>
                    <br>
                    <br>
                    @endif
                @endguest
                <div id='commentAnchor' class='social-links'>
                    <div class='row'>
                        <div class='pull-xs-left'>
                            <a href='https://vk.com/share.php?url=http://myblog/article.php?show=55' class='social-vk' target='_blank'>
                            <img src='/images/000078_social_3d_cubs1_vk.png'>
                            </a>
                        </div>
                        <br>
                        <span class='repost-notification'>Если Вам понравилась или была полезной эта статья, можно сделать репост в социальные сети.
                        </span>

                    </div>
                </div>
                <br>
                @guest
                    <div class='comments-main'>
                        <div class='title-input'>
                            Выполните вход, чтобы оставить комментарий.
                        </div>
                        <br>
                    </div>
                @else
                {!! Form::open(['url' => '/addcomment/submit']) !!}
                    {{ Form::textarea('body', '', ['class'=>'form-control',
                                                        'rows'=>'5', 
                                                        'maxlength'=>1000,
                                                        'placeholder'=>'Комментарий']) }}
                    {{ Form::hidden('post_id', $post->id) }}
                    {{ Form::hidden('user_id', Auth::user()->id) }}
                    {{ Form::hidden('parent_comment_id', 0) }}
                    <br>
                    {{ Form::submit('Добавить комментарий', ['class'=>'comment-btn']) }}
                {!! Form::close() !!}
                @endguest

                @foreach($comments as $basic_comment)
                    @php 
                        $replyId = 'reply_' . $basic_comment->id
                    @endphp

                    <div class='comments-main'>
                        <div class='row comment'>
                            <div class='col-sm-1'>
                                <img class='avatar'  src='images/ava/{{ $basic_comment->user->email }}.jpeg' alt='...'>
                            </div>
                            <div class='col-sm-10 comments1' >
                                <div style='margin-bottom: 0.2em;'>
                                    <div class='comment-author'>{{ $basic_comment->user->name }}</div>
                                    <div class='comment-date'>{{ \Carbon\Carbon::parse($basic_comment->created_at)->format('Y-m-d H:i') }}</div>
                                </div>
                                <div>{{ $basic_comment->body }}</div>
                                <br>                          
                                @guest
                                @else
                                    <button class='comment-btn'  onclick=ShowReplyInput('{{$replyId}}','{{ $basic_comment->user->name }}')>Ответить</button>  
                                    @if (Auth::user()->name == $post->user->name)
                                        <button  class='comment-btn pull-xs-right' onclick=deleteComment('$parent_comment_id')>Удалить</button>
                                        <button  class='comment-btn pull-xs-right' onclick=editComment('$parent_comment_id')>Изменить</button>
                                    @endif
                                    {!! Form::open(['url' => '/addcomment/submit',
                                                    'id'=> $replyId,
                                                    'style'=>"display: none"]) !!}
                                        {{ Form::textarea('body', '', [ 'class'=>'intro-box',
                                                                        'rows'=>'5', 
                                                                        'maxlength'=>1000,
                                                                        'placeholder'=>'Комментарий']) }}
                                        {{ Form::hidden('post_id', $post->id) }}
                                        {{ Form::hidden('user_id', Auth::user()->id) }}
                                        {{ Form::hidden('parent_comment_id', $basic_comment->id) }}
                                        <br>
                                        {{ Form::submit('Добавить комментарий', ['class'=>'comment-btn']) }}
                                    {!! Form::close() !!}
                                @endguest

                                @foreach($nested_comments[$basic_comment->id] as $nested_comment)
                                    @foreach ($nested_comment as $comment)
                                        @php 
                                            $replyId = 'reply_' . $comment->id 
                                        @endphp
                                        <br>  
                                        <div class='row '>
                                            <div class='col-md-1'>
                                                <img class='avatar'  src='images/ava/{{ $comment->user->email }}.jpeg' alt='...'>
                                            </div>
                                            <div class='col-md-10 comments1 '>
                                                <div style='margin-bottom: 0.2em;'>
                                                    <div class='comment-author'>{{ $comment->user->name }}</div>
                                                     <div class='comment-date'>{{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d H:i') }}</div>
                                                </div>
                                                <div>{{ $comment->body }}</div>
                                                <br>
                                                @guest
                                                @else
                                                    <button  class='comment-btn' onclick=ShowReplyInput('{{$replyId}}','{{ $comment->user->name }}')>Ответить</button>
                                                    @if (Auth::user()->name == $post->user->name)
                                                        <button  class='comment-btn pull-xs-right' onclick=deleteComment('$parent_comment_id')>Удалить</button> 
                                                        <button  class='comment-btn pull-xs-right' onclick=editComment('$comment_id')>Изменить</button>
                                                    @endif
                                                    {!! Form::open(['url' => '/addcomment/submit',
                                                                            'id'=> $replyId,
                                                                            'style'=>"display: none"]) !!}
                                                        {{ Form::textarea('body', '', [ 'class'=>'intro-box',
                                                                                        'rows'=>'5', 
                                                                                        'maxlength'=>1000,
                                                                                        'placeholder'=>'Комментарий']) }}
                                                        {{ Form::hidden('post_id', $post->id) }}
                                                        {{ Form::hidden('user_id', Auth::user()->id) }}
                                                        {{ Form::hidden('parent_comment_id', $basic_comment->id) }}
                                                        <br>
                                                        {{ Form::submit('Добавить комментарий', ['class'=>'comment-btn']) }}
                                                    {!! Form::close() !!}

                                                    <form id='{{ $replyId }}' style='display: none;'>
                                                            <textarea class='intro-box' id='' name='body'  rows='5' maxlength='1000' placeholder='Комментарий' value='xxx'></textarea>
                                                            <input id='' type='hidden' name='post_id' value='$art_id'>
                                                            <input id='' type='hidden' name='parent_comment_id' value='$parent_comment_id'>
                                                            <button  class='comment-btn pull-xs-right' onclick = 'return TimeToSendComment(art_id,  parent_comment_id, comment_body)'>Добавить комментарий</button>

                                                            <div style='clear: both;'></div>
                                                    </form> 
                                                    <br>
                                                 @endguest                         
                                            
                                            </div>  
                                        </div>
                                        <br>
                                    @endforeach
                                @endforeach 
                            </div>
                        </div>
                    </div> 
                @endforeach

                <script type="text/javascript">
                //--- Принимаем строку со значением идентификатора -----------------------
                function ShowReplyInput(elem, name)   
                {
                    elem2 = '#'+elem+' > textarea';
                    commentForm = document.getElementById(elem);

                    if(commentForm.style.display == "block")
                        commentForm.style.display = "none";
                    else
                        commentForm.style.display = "block";

                    document.querySelectorAll(elem2)[0].value = name+','+' ';

                }
                //------------------------------------------------------------------------
            </script> 
            </div>
        </div>
    </div>
    @include('inc.sidebar')
@endsection

