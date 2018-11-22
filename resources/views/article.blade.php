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
                
                <hr>
                @guest
                @else
                    @if (Auth::user()->name == $post->user->name)
                    <a href='/addpost/{{$post->id}} '><button class="comment-btn pull-xs-right">Изменить</button></a>
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
                        $replyId = 'reply_' . $basic_comment->id;
                        $commentId = 'comment_' . $basic_comment->id;
                    @endphp

                    <div class='comments-main'>
                        <div class='row comment'>
                            <div class='col-sm-1'>
                                <img class='avatar'  src='images/ava/{{ $basic_comment->user->email }}.jpeg' alt='...'>
                            </div>
                            <div class='col-sm-10 comments1' >
                                <div class='mt-2'>
                                    <div class='comment-author'>{{ $basic_comment->user->name }}</div>
                                    <div class='comment-date'>{{ \Carbon\Carbon::parse($basic_comment->created_at)->format('Y-m-d H:i') }} id:{{$basic_comment->id}}</div>
                                </div>
                                <div id={{ $commentId }} class='mt-2'>{{ $basic_comment->body }}</div>
                                <br>                          
                                @guest
                                @else
                                    <button class='comment-btn'  onclick=ShowReplyInput('{{$replyId}}','{{ $basic_comment->user->name }}')>Ответить</button>  
                                    @if (Auth::user()->name == $basic_comment->user->name)
                                        <button  class='comment-btn pull-xs-right' onclick="ShowEditInput('{{ $replyId }}', '{{ $commentId }}', '{{$basic_comment->id}}', '{!! csrf_token() !!}')">Изменить</button>
                                        <button  class='comment-btn pull-xs-right' onclick=deleteComment('{{$basic_comment->id}}')>Удалить</button>
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
                                        {{ Form::hidden('comment_id', $basic_comment->id) }}
                                        <br>
                                        {{ Form::submit('Добавить комментарий', ['class'=>'comment-btn']) }}
                                    {!! Form::close() !!}
                                @endguest
                                <br>  
                                
                                @foreach($nested_comments[$basic_comment->id] as $nested_comment)
                                    @foreach ($nested_comment as $comment)
                                        @php 
                                            $replyId = 'reply_' . $comment->id;
                                            $commentId = 'comment_' .$comment->id;  
                                        @endphp
                                        
                                        <br>
                                        <div class='row '>
                                            <div class='col-md-1'>
                                                <img class='avatar'  src='images/ava/{{ $comment->user->email }}.jpeg' alt='...'>
                                            </div>
                                            <div class='col-md-10 comments1 '>
                                                <div class='mt-2'>
                                                    <div class='comment-author'>{{ $comment->user->name }}</div>
                                                     <div class='comment-date'>{{ \Carbon\Carbon::parse($comment->created_at)->format('Y-m-d H:i') }} id:{{$comment->id}}</div>
                                                </div>
                                                <div id={{ $commentId }} class="mt-2">{{ $comment->body }}</div>
                                                <br>
                                                @guest
                                                @else
                                                    <button  class='comment-btn' onclick=ShowReplyInput('{{ $replyId }}','{{ $comment->user->name }}')>Ответить</button>
                                                    @if (Auth::user()->name == $comment->user->name)
                                                        <button  class='comment-btn pull-xs-right' onclick="ShowEditInput('{{ $replyId }}', '{{ $commentId }}', '{{$comment->id}}', '{!! csrf_token() !!}' )">Изменить</button>
                                                        <button  class='comment-btn pull-xs-right' onclick="deleteComment('{{$comment->id}}', '{!! csrf_token() !!}')">Удалить</button>
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
                                                        {{ Form::hidden('comment_id', $comment->id) }}
                                                        <br>
                                                        {{ Form::submit('Добавить комментарий', ['class'=>'comment-btn']) }}
                                                    {!! Form::close() !!}

                                                    <!--form id='{{ $replyId }}' style='display: none;'>
                                                            <textarea class='intro-box' id='' name='body'  rows='5' maxlength='1000' placeholder='Комментарий' value='xxx'></textarea>
                                                            <input id='' type='hidden' name='post_id' value='$art_id'>
                                                            <input id='' type='hidden' name='parent_comment_id' value='$parent_comment_id'>
                                                            <button  class='comment-btn pull-xs-right' onclick = 'return TimeToSendComment(art_id,  parent_comment_id, comment_body)'>Добавить комментарий</button>

                                                            <div style='clear: both;'></div>
                                                    </form--> 
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
                    textArea = '#'+elem+' > textarea';
                    buttonSubmit = '#'+elem+' :last-child';
                    commentForm = document.getElementById(elem);
                    document.querySelectorAll(buttonSubmit)[0].value = 'Добавить комментарий';

                    if(commentForm.style.display == "block")
                        commentForm.style.display = "none";
                    else
                        commentForm.style.display = "block";

                    document.querySelectorAll(textArea)[0].value = name+','+' ';
                }

                function ShowEditInput(elem, comment, comment_id, csrf_token)   
                {
                    textArea = '#'+elem+' > textarea';
                    buttonSubmit = '#'+elem+' :last-child';
                    commentForm = document.getElementById(elem);

                    if(commentForm.style.display == "block")
                        commentForm.style.display = "none";
                    else
                        commentForm.style.display = "block";

                    // Манимауляции с текмтовым полем, куда вводим то, что будет отправляться.
                    document.querySelectorAll(textArea)[0].value = document.getElementById(comment).innerHTML;  
                    // Манимауляции с кнопкой Submit
                    btn = document.querySelectorAll(buttonSubmit)[0];
                    btn.value = 'Сохранить комментарий';

                    btn.onclick = function(){   // Функция отправляет Ajax запрос с обновленными данными. 
                        token = document.querySelectorAll     ('#'+elem+' :nth-child(1)')[0].value;
                        body = document.querySelectorAll      ('#'+elem+' :nth-child(2)')[0].value;
                        comment_id = document.querySelectorAll('#'+elem+' :nth-child(6)')[0].value;
                        submit = document.querySelectorAll    ('#'+elem+' :nth-child(8)')[0].value;

//                      alert( post_id.value );
                        var data = new FormData();
                        data.append('id', comment_id); 
                        data.append('body', body); 
                        data.append('_token', csrf_token); 

                        request = new ajaxRequest()
                        request.open("POST", "/editcomment", true)

                        request.onreadystatechange = function()
                        {
                            if (this.readyState == 4)
                                if (this.status == 200)
                                    if (this.responseText != null)
                                    {
                                    //    alert(this.responseText);
                                        location.reload();
                                    }
                        }
                        request.send(data);     
                        return false;
                    }
                }
                //------------------------------------------------------------------------
            </script> 
            </div>
        </div>
    </div>
    @include('inc.sidebar')
@endsection

