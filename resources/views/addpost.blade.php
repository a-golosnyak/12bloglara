@extends('layouts.main')


@section('content')  
    <div class='col-md-8 blog-main'>
        <script type="text/javascript" src="{{URL::asset('ckeditor/ckeditor.js')}}"></script> <!-- Текстовый редактор для постов -->
        <div class='profile-field ' >
            <h3 class='form-signin-heading profile-title'>Создание поста от <b>{{ Auth::user()->name }}</b></h3>
            <br>
            {!! Form::open(['url' => $action, 'files'=>'true']) !!}
                <div class="preview-area">
                    <p>
                        <h5 class="sel-category float-left">Категория:</h5>
                        {{ Form::select('category', $categories, ['id'=>"post_category"]) }}
                    </p>
                    <p>
                        {{ Form::textarea('post_title', $post_title, ['id'=>"post_title",
                                                                'class'=>'title-box', 
                                                                'maxlength'=>'220', 
                                                                'rows'=>'3',
                                                                'placeholder'=>"Заголовок. Максимальная длинна 220 - символов."]) }} 
                    </p>
                    <p>
                        {{ Form::textarea('post_intro', $post_intro, ['id'=>"post_intro",
                                                                'class'=>'intro-box', 
                                                                'maxlength'=>'1200', 
                                                                'rows'=>'5',
                                                                'placeholder'=>"Превью статьи. Попробуйте уложиться в 1200 - символов."]) }}     
                    </p>
                    {{ Form::hidden('id', $post_id) }}
                    {{ Form::hidden('author', Auth::user()->id) }}
                    {{ Form::file('post_image', ['id'=>'post-file'] ) }}
                    <span class="float-right">Размер до 10Мб</span>
                    <br>
                    
                    @if(isset($image))
                        <img class="w-100 mt-1" id="output" src="{{$image}}">
                    @else
                        <img class="w-100 mt-1" id="output" style="display: none;">
                    @endif

                    <script>
                        document.getElementById("post-file").onchange = function() {
                            var output = document.getElementById('output');
                            output.style.display = 'block';
                            output.src = URL.createObjectURL(event.target.files[0]);
                        };
                    </script>
                </div>
            
                <div id="area" >
                    {{ Form::textarea('post_body', $body, ['id'=>"postBody",
                                                        'rows'=>'40',
                                                        'cols'=>'80']) }} 
                {{--    <textarea name="post_body" id="postBody" rows="40" cols="80">
                        {!! $body !!}
                    </textarea> --}}

                    <script>
                        CKEDITOR.replace('postBody');
                        CKEDITOR.config.extraPlugins  = 'codesnippet';
                        CKEDITOR.config.extraPlugins  = 'autogrow';                        
                    </script>
                </div>
                <br>
                {{ Form::submit('Опубликовать', ['id'=>"post_submit", 'class'=>'addpost-btn']) }}
            {!! Form::close() !!}  
        </div>
    </div><!-- /.blog-main -->
    @include('inc.sidebar')
@endsection

