<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'id'      => '1',
            'name'      => 'adm',
            'email'     => 'adm@mail.ru',
            'password'  => Hash::make('111111')
        ]);
    }
}
