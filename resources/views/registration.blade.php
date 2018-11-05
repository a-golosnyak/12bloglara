@extends('layouts.app')

@section('content')
<div class='col-md-12 blog-main'>
    <div class='reg-field'>
        <div class=" registration-container " style="height: 100%;">
            <form class="form-signin" action="registration.php" method="post" 
            onSubmit='return validateRegFormAll(this)'>
                <h2 class="form-signin-heading">Регистрация</h2>
                <div>
                    <input type="email" name="email" class="form-control form-signup page-item" placeholder="Email" required onblur='checkUser(this)'>
                    <div id="emailOk" class="page-item">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                </div>
                <br>
                <div>
                    <input type="password" name="password" id="password" class="form-control form-signup page-item" placeholder="Пароль" required onkeyup="validatePassword(this, password_confirm)">
                    <div id="pass1Ok" class="page-item">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                </div>
                <div>
                    <input type="password" name="password_confirm" class="form-control form-signup page-item" placeholder="Повторите пароль" required onkeyup="validatePassword(password, this)">
                    <div id="pass2Ok" class="page-item">
                       <i class="fas fa-asterisk "></i> 
                   </div>
                </div>
                <br>
                <div>
                    <input type="text" name="screen_name" class="form-control form-signup page-item" placeholder="Имя" required onkeyup = "validateName(this)">
                    <div id="nameOk" class="page-item">
                        <i class="fas fa-asterisk "></i> 
                    </div>
                </div>
                <br>
                <div>
                    <button type="submit" class="btn btn-lg btn-primary btn-block form-control form-signup page-item" >Зарегистрироваться</button>
                    <i class="fas fa-asterisk " style="color: #eee"></i> 
                </div>
            </form>
        </div> <!-- /container -->
    </div>
</div>
@endsection


