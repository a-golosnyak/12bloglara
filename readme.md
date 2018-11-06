Install

1. composer install
2. php artisan key:generate

.env file database settings

sudo chmod 775 bootstrap/cache

sudo chmod 775 storage

sudo chgrp -R www-data storage bootstrap/cache


As outlined in the Migrations guide to fix this all you have to do is edit your AppServiceProvider.php file and inside the boot method set a default string length:

use Illuminate\Support\Facades\Schema;

public function boot()
{
    Schema::defaultStringLength(191);
}
