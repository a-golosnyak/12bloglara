<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = Category::firstOrCreate(['id' => '1', 'name'=>'Микроконтроллеры STM32']);
        $categories->save();
        $categories = Category::firstOrCreate(['id' => '2', 'name'=>'Программирование Linux']);
        $categories->save();
        $categories = Category::firstOrCreate(['id' => '3', 'name'=>'Электроника']);
        $categories->save();
        $categories = Category::firstOrCreate(['id' => '4', 'name'=>'WEB-разработка']);
        $categories->save();
        $categories = Category::firstOrCreate(['id' => '5', 'name'=>'Разное']);
        $categories->save();
    }
}
