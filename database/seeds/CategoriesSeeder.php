<?php

use Illuminate\Database\Seeder;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::update("INSERT INTO categories SET name='Микроконтроллеры STM32'");
        DB::update("INSERT INTO categories SET name='Программирование Linux'");
        DB::update("INSERT INTO categories SET name='Электроника'");
        DB::update("INSERT INTO categories SET name='WEB-разработка'");
        DB::update("INSERT INTO categories SET name='Разное'");
    }
}
