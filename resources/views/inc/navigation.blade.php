
<!--div class="navigation">
    <div class="container nav">
        <div class="nav nav-tabs float-left ">
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
                <a class="nav-link " href="/about">О сайте</a>
            </div>
        </div>
 
        <div class="nav-tabs float-right ">
            <form class=" nav-item" >
                <input class="form-control search .d-inline" type="search" placeholder="Найти" aria-label="Search" size="15">
                <span class="item-search nav-item .d-inline" ><i class="fab fa-sistrix"></i></span>
            </form>
        </div>

        <div class="nav nav-tabs float-right">
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
                    <a class='none-decored' href='/registration'>
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
</div-->


<nav class="navigation navbar navbar-expand-lg navbar-dark ">
    <div class="container ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item  ">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
        </div>
        <form class="form-inline my-2 my-lg-0 ml-auto mx-4">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
            <span class=" item-search nav-item .d-inline" ><i class="fab fa-sistrix"></i></span>
        </form>


            <ul class="navbar-nav">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">Dropdown</a>
                    <div class="dropdown-menu dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
                      <a class="dropdown-item" href="#">Action</a>
                      <a class="dropdown-item" href="#">Another action</a>
                      <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                  </li>
            </ul>

    </div>
</nav>
