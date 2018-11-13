@extends('layouts.main')


@section('content')  
    <div class='col-md-8 blog-main'>
        <script src="ckeditor/ckeditor.js"></script>      <!-- Текстовый редактор для поств -->
        <div class='profile-field ' >
           <h3 class='form-signin-heading profile-title'>Создание поста от <b>$usermail</b></h3>
                <br>
                {!! Form::open(['url' => 'createad/submit']) !!}
                <div class="preview-area">
                    <p>
                        <h5 class="sel-category">Категория:</h5>
                        {{  Form::select('animal', $categories) }}

                    </p>
                    <p>
                        <!-- <p><input type="text" name="" rows=4 style="width: 70%;"></p> -->
                        <div class="title-input">
                            <textarea class="title-box" id="art_title" name="art_title"  rows='3' maxlength='220' placeholder="Заголовок. Максимальная длинна 220 - символов."></textarea>
                        </div>
                    </p>
                    <p>
                        <!-- <p><input type="text" name="" rows=4 style="width: 70%;"></p> -->
                        <div class="intro-input">
                            <textarea class="intro-box" id="art_intro" name="art_intro"  rows='5' maxlength='1200' placeholder="Превью статьи. Попробуйте уложиться в 1200 - символов."></textarea>

                            {{ Form::textarea('art_intro', '', ['class'=>'intro-box']) }}

                        </div>
                    </p>
                    <input type="file"  onchange="loadFile(event)">
                    <br>
                    <img class="w-100" id="output" style="display: none; margin-top: 1em;">
                    <script>
                        var loadFile = function(event) {
                            var output = document.getElementById('output');
                            output.style.display = 'block';
                            output.src = URL.createObjectURL(event.target.files[0]);
                        };
                    </script>
                </div>
            
                <div id="area" >
                    <textarea name="post-body" id="postBody" rows="40" cols="80">
                        Начните вводить пост.
                    </textarea>

                    <script>
                        CKEDITOR.replace('postBody');
                        CKEDITOR.config.extraPlugins  = 'codesnippet';
                        CKEDITOR.config.extraPlugins  = 'autogrow';                        
                    </script>
                </div>
                <br>
                <button  class='addpost-btn' onclick="return TimeToSubmitPost(category, art_title, art_intro )" style='text-align: center;'>Опубликовать</button>
            {!! Form::close() !!}  
        </div>
    </div><!-- /.blog-main -->
    @include('inc.sidebar')
@endsection

