﻿	Local installation.

1. composer install
	1.1. 	sudo chmod 775 bootstrap/cache		// 777
		sudo chmod 775 storage				// 777
		sudo chmod 775 /storage/logs
		sudo chmod 775 /storage/framework/views
		sudo chgrp -R www-data storage bootstrap/cache
		
	1.2. 	sudo ln -s /etc/nginx/sites-available/example.com /etc/nginx/sites-enabled/

2. php artisan key:generate
3. composer require "laravelcollective/html"	- allow to use forms
4. .env file database settings
5. php artisan migrate

6. 	php.ini:
	post_max_size = 12M
	upload_max_filesize 10M

//---------------------------------------------------------------------------------------------

	Must be done for executing project on Linux server.
	
1.1. 	sudo chmod 775 bootstrap/cache		// 777
		sudo chmod 775 storage				// 777
		sudo chmod 775 /storage/logs
		sudo chmod 775 /storage/framework/views
		sudo chmod 775 /storage/framework/sessions
		sudo chgrp -R www-data storage bootstrap/cache

1.2. 	sudo ln -s /etc/nginx/sites-available/example.com /etc/nginx/sites-enabled/
//---------------------------------------------------------------------------------------------

sudo ln -s /etc/nginx/sites-available/example.com /etc/nginx/sites-enabled/

	Common things

As outlined in the Migrations guide to fix this all you have to do is edit your 
AppServiceProvider.php 
file and inside the boot method set a default string length:

use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}
//---------------------------------------------------------------------------------------------

По сайту сделать:
1. Валидацию изменяемых в профиле пользователя данных. +
2. Репост в соцсети.
3. Картинка профиля. При регистрации и в настройках профиля. +
4. Сайдбар.
5. Смену пароля переделать. +