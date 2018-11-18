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
                {{ $post->body }}
                <br>
                <br>
                @guest
                @else
                    @if (Auth::user()->name == $post->user->name)
                    <a href="/delete/{{$post->id}}"><button class="comment-btn pull-xs-right">Изменить</button></a>
                    <a href="/edit/{{$post->id}}"><button class="comment-btn pull-xs-right">Удалить</button></a>
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

                {!! Form::open(['url' => 'addcomment/submit']) !!}
                    {{ Form::textarea('description', '', ['class'=>'form-control', 'placeholder'=>'Tipe ad here']) }}
                    {{ Form::hidden('author', Auth::user()->id, ['class'=>'form-control']) }}
                    <br>
                    {{ Form::submit('Добавить комментарий', ['class'=>'comment-btn']) }}
                {!! Form::close() !!}

                    <form id='$replyId' style='display: block;'>
                        <div class='title-input'>
                            <textarea class='intro-box' id='' name='comment_body'  rows='5' maxlength='1000' placeholder='Комментарий''></textarea>
                        </div>
                        <input id='' type='hidden' name='art_id' value='$art_id'>
                        <input id='' type='hidden' name='parent_comment_id' value='0'>
                        <button  class='comment-btn pull-xs-right'  onclick = 'return TimeToSendComment(art_id,  parent_comment_id, comment_body)'>Добавить комментарий</button>
                                    <div style='clear: both;'></div>

                        <div style='clear: both;'></div>
                    </form>
                @endguest
                <div class='comments-main'>
                    <div class='row comment'>
                        <div class='col-sm-1'>
                            <img class='avatar'  src='images/ava/$author_mail.jpeg' alt='...'>
                        </div>
                        <div class='col-sm-10 comments1' >
                            <div style='margin-bottom: 0.2em;'>
                                <div class='comment-author'>$author_screen_name</div>
                                <div class='comment-date'>$pub_date</div>
                            </div>
                            <div>$comment_body</div>
                            <br>                          

                            <button class='comment-btn'  onclick=ShowReplyInput('$replyId','$author_screen_name')>Ответить</button>  
                            <button  class='comment-btn pull-xs-right' onclick=deleteComment('$parent_comment_id')>Удалить</button>
                            <button  class='comment-btn pull-xs-right' onclick=editComment('$parent_comment_id')>Изменить</button>

                            <form id='$replyId' style='display: none;'>
                                <textarea class='intro-box' id='' name='comment_body'  rows='5' maxlength='1000' placeholder='Комментарий''></textarea>
                                <input id='' type='hidden' name='art_id' value='$art_id'>
                                <input id='' type='hidden' name='parent_comment_id' value='$parent_comment_id'>
                                <button  class='comment-btn pull-xs-right' onclick = 'return TimeToSendComment(art_id,  parent_comment_id, comment_body)'>Добавить комментарий</button>
                            <div style='clear: both;'></div>
                            </form>

                            <div class='row '>
                                <div class='col-md-1'>
                                    <img class='avatar'  src='images/ava/$author_mail.jpeg' alt='...'>
                                </div>
                                <div class='col-md-10 comments1 '>
                                    <div style='margin-bottom: 0.2em;'>
                                        <div class='comment-author'>$author_screen_name</div>
                                         <div class='comment-date'>$pub_date</div>
                                    </div>
                                    <div>$comment_body</div>
                                    <br>
                                    <button  class='comment-btn' onclick=ShowReplyInput('$replyId','$author_screen_name')>Ответить</button>
                                    <button  class='comment-btn pull-xs-right' onclick=deleteComment('$parent_comment_id')>Удалить</button> 
                                    <button  class='comment-btn pull-xs-right' onclick=editComment('$comment_id')>Изменить</button>
                                    <form id='$replyId' style='display: none;'>
                                            <textarea class='intro-box' id='' name='comment_body'  rows='5' maxlength='1000' placeholder='Комментарий'' value='xxx'></textarea>
                                            <input id='' type='hidden' name='art_id' value='$art_id'>
                                            <input id='' type='hidden' name='parent_comment_id' value='$parent_comment_id'>
                                            <button  class='comment-btn pull-xs-right' onclick = 'return TimeToSendComment(art_id,  parent_comment_id, comment_body)'>Добавить комментарий</button>

                                            <div style='clear: both;'></div>
                                    </form> 

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
                
                                <br>
                                </div>  
                            </div>
                            <br>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    @include('inc.sidebar')
@endsection

