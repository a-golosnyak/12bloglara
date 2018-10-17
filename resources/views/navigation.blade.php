
<div class="navigation">
    <div class="row ">
        <div class="container">
            <div class="col-xs-6"> 
                <div class="nav nav-tabs ">
                    <div class="nav-item">
                        <div class="nav-link">
                            <a class='none-decored' href="index.php">Главная</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <div class="nav-link dropdown-toggle" id="getCategory" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false" onclick="GetCategory();">Рубрика</div>
                        <div class="dropdown-menu dropdown-menu-left"  id="Categories" >
                        </div>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link disabled" href="#">Контакты</a>
                    </div>
                    <div class="nav-item">
                        <a class="nav-link " href="about.php">О сайте</a>
                    </div>
                </div>
            </div>
            <div class=" col-xs-1">

            </div>
            <div class=" col-xs-3"> 
                <div class="row">
                    <div class="nav-tabs">
                        <form class=" nav-item" >
                            <input class="form-control search" type="search" placeholder="Найти" aria-label="Search" size="15">
                        </form>
                        <div class="item-search nav-item" ><i class="fab fa-sistrix"></i></div>
                    </div>
                </div>
            </div>
            <div class=" col-xs-2">
                <div class="nav nav-tabs">
                    <div class="nav-item dropdown " style="vertical-align: right;">
                        <div class='nav-link dropdown-toggle' data-toggle='dropdown' href='#' role='button' aria-haspopup='true' aria-expanded='false'>Вход</div>
                        <div class='dropdown-menu dropdown-menu-right'>
                            <form class='form-signin' method='post' action='index.php'>
                                <div class='dropdown-item' href='#'>
                                    <input type='email' name='usermail' maxlength='30' size='20' class='form-control' placeholder='Email address' required autofocus>
                                </div>

                                <div class='dropdown-item' href='#'>
                                    <input type='password' name='pass' class='form-control' size='40' placeholder='Password' required>
                                </div>
                                <div class='dropdown-item text-xs-center' href='#'>
                                    <div class='checkbox '>
                                        <div>
                                            <input type='checkbox' name='remember'> Запомнить меня  
                                        </div>
                                        <a class='passrecovery' href='passrecovery.php'>  Забыли пароль?</a>
                                    </div>

                                </div>
                                <div class='dropdown-item' href='#'>
                                    <button class='btn btn-lg btn-primary btn-block' type='submit'>Вход </button>
                                </div>
                            </form>
                            <div class='dropdown-divider'></div>
                            <a class='none-decored' href='registration.php'>
                                <div class='dropdown-item' href='#'>
                                    <button class='btn btn-md btn-primary btn-block' type='submit'>
                                        Регистрация
                                    </button>
                                </div> 
                            </a>
                        </div>   
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

