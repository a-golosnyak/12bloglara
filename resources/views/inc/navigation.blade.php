<nav class="navigation navbar navbar-expand-md">
    <div class="container ">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item  ">
                    <a class="nav-link" href="/">Главная </a>
                </li>
                <li class="nav-item">
                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">Рубрики</a>
                        <div class="dropdown-menu dropdown-primary dropdown-menu-left" aria-labelledby="navbarDropdownMenuLink">
                            @foreach ($categories as $category)
                                <a class="dropdown-item" href="/categoty/{{$loop->index + 1}}">{{ $category }}</a>
                            @endforeach
                        </div>
                    </li>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contacts">Контакты</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/about">О сайте</a>
                </li>
            </ul>
        </div>
        <form class="form-inline my-2 my-lg-0 ml-auto mx-4">
            <input class="form-control" type="search" placeholder="Поиск" aria-label="Search">
            <span class=" item-search " ><i class="fab fa-sistrix"></i></span>
        </form>

        <ul class="navbar-nav">
            <li class="nav-item dropdown ">
                @guest
                    <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">Вход</a>
                    <div class="dropdown-menu dropdown-primary dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <form class='form-signin' method='post' action='{{ route('login') }}'>
                            @csrf
                            <div class='dropdown-item' href='#'>
                                <input type='email' name='email' maxlength='20' size='20' class='form-control' placeholder='Email address' required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <div class='dropdown-item text-center' href='#'>
                                <input type='password' name='password' class='form-control{{ $errors->has('password') ? ' is-invalid' : '' }}' size='20' placeholder='Password' required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class='dropdown-item text-center my-2 py-1' href='#'>
                                <input type='checkbox' name='remember' {{ old('remember') ? 'checked' : '' }}> Запомнить меня  
                            </div>

                            <div class='dropdown-item' href='#'>
                                <button class='btn btn-md btn-primary btn-block' type='submit'>Вход </button>
                            </div>
                        </form>
                        <div class='dropdown-item text-center my-0 py-0' href='#'>
                            <div>Вход через соцсети</div>
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
                                <a href='auth/github' class='social-vk'>
                                    <img src='/images/social/github-social-media-logo-64.png'>
                                </a>
                            </span>
                        </div>

                        <div class='dropdown-item text-center my-0 py-0' href='#'>
                            <a class="link" href='{{ route('password.request') }}'>  Забыли пароль?</a>
                        </div>

                        <div class='dropdown-divider'></div>
                        <a class='none-decored w-100' href='/registration'>
                            <div class='dropdown-item text-xs-center' href='#'>
                                <button class='btn btn-md btn-primary btn-block text-xs-center' type='submit'>
                                    Регистрация
                                </button>
                            </div> 
                        </a>
                    </div>
                @else
                    <a class="nav-link dropdown-toggle m-0 p-0" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                      aria-expanded="false">
                        <img class='avatar' src="{{asset('images/ava/' . Auth::user()->email. '.jpeg') }}" alt='...'>
                    </a>
                    <div class="dropdown-menu dropdown-primary dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                        <a class='dropdown-item' href='/profile/{{ Auth::user()->id }}'>Вы вошли как {{ Auth::user()->name }}</a>
                        <a class=' dropdown-item none-decored ' href='/profile/{{ Auth::user()->id }}'>Профиль</a>
                        <div class='dropdown-divider'></div>
                            <a class="dropdown-item" href="{{ route('logout') }}" 
                                                    onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">Выход</a>
                        </div>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div> 
                @endguest
            </li>
        </ul>

    </div>
</nav>
