<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        DB::update("INSERT INTO categories SET name='Микроконтроллеры STM32'");
        DB::update("INSERT INTO categories SET name='Программирование Linux'");
        DB::update("INSERT INTO categories SET name='Электроника'");
        DB::update("INSERT INTO categories SET name='WEB-разработка'");
        DB::update("INSERT INTO categories SET name='Разное'");
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
