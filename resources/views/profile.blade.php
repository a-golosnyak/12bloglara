@extends('layouts.main')


@section('content')  
    <div class='col-md-8 blog-main'>
        <div class='profile-field ' >
            <h3 class='form-signin-heading profile-title'>Ваш профиль <b>{{ Auth::user()->name }}</b></h3> 
             <!--style='border: 1px solid grey;' -->
            <br>
            <div class='row' >
                <div class='col-sm-4'>
                    <span>Написать пост?</span>
                </div>
                <div class='col-sm-5'></div>
                <a class='col-sm-3' href='/addpost'>
                    <div>
                        <button type='submit' class='profile-btn' style='text-align: center;'>Написать!</button>
                    </div>
                </a>
            </div> 
            <hr>
            <div class='row' >
                <div class='col-sm-4'>
                    <span>Все мои статьи</span>
                </div>
                <div class='col-sm-5'></div>
                <form class='col-sm-3' action='/ofuser/{{ Auth::user()->id }}' method='get'>
                    <input type='hidden' name='show' value='user_articles'>
                    <button type='submit' class='profile-btn' style='text-align: center;'>Посмотерть</button>
                </form>
            </div>
            <hr>
            <div class='row' >
                <div class='col-sm-4 float-left'>
                    <span>Профиль создан</span>
                </div>
                <div class='float-right ml-auto' >
                    <span class='profile-meta mr-5' >{{ \Carbon\Carbon::parse($user->created_at)->format('Y-m-d H:i')}}</span>
                </div>
            </div> 
            <hr>
            <form class='row form-signin' action='/setname' method='post'>
                @csrf
                <div class='col-sm-4'>
                    <label for='name'>Имя</label>
                </div>
                <div class='col-sm-5'>
                    <input class="d-inline" type='name' id='name' name='name' placeholder={{ Auth::user()->name }} required onkeyup = 'validateName(this)' size='18'>
                    <div id='nameOk' class='page-item d-inline'>
                        <i class='fas fa-asterisk'></i>
                    </div>
                </div>
                <div class='col-sm-3' >
                    <button type='submit' class='profile-btn' style='text-align: center;'>Применить</button>
                </div>
            </form>
            <hr>
            <form class='row form-signin' action='/setemail' method='post'>
                @csrf
                <div class='col-sm-4'>
                    <label for='inputEmail'>Электронная почта</label>
                </div>
                <div class='col-sm-5'>
                    <input class="d-inline" type='email' id='inputEmail' name='email' placeholder={{ Auth::user()->email }} required onblur="checkUser(this, '{!! csrf_token() !!}')" size='18'>
                    <div id='emailOk' class='d-inline' >
                        <i class='fas fa-asterisk'></i>
                    </div>
                </div>
                <div class='col-sm-3' >
                    <button type='submit' class='profile-btn disabled' >Применить</button>
                </div>
            </form>
            <hr>
            <form class='form-signin' action='/setpassword' method='post' onsubmit="validatePassword(password, password_confirm)">
                @csrf
                <div class='row'>
                        <div class='col-sm-4'>
                            <p>Пароль</p>
                            <p>Повторите пароль</p>
                        </div>
                        <div class='col-sm-5'>
                            <div>
                                <input class="d-inline" type='password' name='password'  placeholder='Пароль' required onkeyup='validatePassword(this, password_confirm)' size='18'>
                                <div id='pass1Ok' class='page-item d-inline' style="top: 100px; "> 
                                    <i class='fas fa-asterisk'></i>
                                </div>
                            </div>

                            <input class="d-inline" type='password' name='password_confirm'  placeholder='Повторите пароль'  required onkeyup='validatePassword(password, this)' size='18'>
                            <div id='pass2Ok' class='page-item d-inline'>
                                <i class='fas fa-asterisk'></i>
                            </div>
                        </div>
                        <div class='col-sm-3' style='' >
                            <button type='submit' class='profile-btn' >Применить</button>
                        </div>
                </div>
            </form>
            <hr>
            <br>
            <div class="row preview-zone ">
                <form class="form-signin text-center mx-auto" method= 'post' action='' enctype='multipart/form-data'>
                    <h5 class="photo-item">Фото профиля</h5>
                    <img class='crop jcrop-holder' src='{{asset('images/ava/'. Auth::user()->email .'.jpeg') }}' id='ProfilePhoto'  />
                    <br>
                    <label for="InpProfilePhoto" >
                        <span class='btn btn-md btn-chose-new-photo' id="InpProfileSelect" >Загрузить новую картинку</span>
                        <input type="file" id="InpProfilePhoto" style="display:none" aria-hidden="true">
                    </label>

                    <button class="profile-btn mb-2 mr-3" id="PhotoCancel"crop style="display: none" href='profile.php'>Отмена</button>

                    <button type="submit" class="profile-btn mb-2" id="PhotoSubmit" style="display:none">Загрузить</button>  
                    <br class="mb-3">
                </form>
            </div> 
            <!-- This is the form that our event handler fills      DEBUG SECTION ***   -->
            <form id="coords"
                class="coords"
                onsubmit="return false;">

                <div class="inline-labels" id="InlineLabels" style="display:none">
                    <label>X1 <input type="text" size="4" id="x1" name="x1" /></label>
                    <label>Y1 <input type="text" size="4" id="y1" name="y1" /></label>
                    <label>X2 <input type="text" size="4" id="x2" name="x2" /></label>
                    <label>Y2 <input type="text" size="4" id="y2" name="y2" /></label>
                    <label>W <input type="text" size="4" id="w" name="w" /></label>
                    <label>H <input type="text" size="4" id="h" name="h" /></label>
                </div>
            </form>         
            <div class="row">
                <div class="col-sm-6">
                    <div id="preview-pane">
                        <div class="preview-container">
                            <img src="" class="jcrop-preview" id="PreviewArea" alt="Preview" style="display:none;"/>
                        </div>
                    </div>
                </div> 
            </div>
            <br style="clear: both;">
        </div>      
    </div><!-- /.blog-main -->

    @include('inc.sidebar')
@endsection
