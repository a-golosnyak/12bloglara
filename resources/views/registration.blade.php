@extends('layouts.main')

@section('content')
    <div class=' blog-main brown lighten-5 w-100 py-5'>
        <div class="text-center">
            <form class="form-signin" action="{{ route('register') }}" method="post" 
            onSubmit='return validateRegFormAll(this)'>
                @csrf
                <h2 class="form-signin-heading">Регистрация</h2>
                <div>
                    <input id="email" type="email" name="email" class="form-control form-signup d-inline" placeholder="Email" required onblur="checkUser(this, '{!! csrf_token() !!}')">
                    <div id="emailOk" class="d-inline">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                    @if ($errors->has('email'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
                <br>
                <div>
                    <input id="password" type="password" name="password" id="password" class="form-control form-signup d-inline" placeholder="Пароль" required onkeyup="validatePassword(this, password_confirm)">
                    <div id="pass1Ok" class="d-inline">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                    @if ($errors->has('password'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
                </div>
                <div>
                    <input id="password-confirm"  type="password" name="password_confirmation" class="form-control form-signup d-inline" placeholder="Повторите пароль" required onkeyup="validatePassword(password, this)">
                    <div id="pass2Ok" class="d-inline">
                       <i class="fas fa-asterisk "></i> 
                   </div>
                </div>
                <br>
                <div>
                    <input id="name" type="text" name="name" class="form-control form-signup d-inline" placeholder="Имя" required onkeyup = "validateName(this)">
                    <div id="nameOk" class="d-inline">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                    @if ($errors->has('name'))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>
                <br>

                <div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block form-control form-signup d-inline" >Зарегистрироваться</button>
                    <div id="nameOk" class="d-inline ">
                        <i class="fas fa-asterisk opacity-0"></i> 
                    </div>
                </div>
                <br>
            </form>
            <br>
            <span class='pull-xs-left'>
                <a href='https://github.com/' class='social-vk' target='_blank'>
                <img src='/images/social/facebook-social-media-logo-64.png'>
                </a>
            </span>
            <span class='pull-xs-left'>
                <a href='https://github.com/' class='social-vk' target='_blank'>
                <img src='/images/social/LinkedIn-social-media-logo-64.png'>
                </a>
            </span>
            <span class='pull-xs-left'>
                <a href='auth/github' class='social-vk' target='_blank'>
                <img src='/images/social/github-social-media-logo-64.png'>
                </a>
            </span>
            <div class="my-5 py-5"></div>
        </div>
    </div>
@endsection

{{--@section('footer')
@endsection--}}


