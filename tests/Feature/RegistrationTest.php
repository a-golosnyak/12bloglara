<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistrationTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test1()
    {
        $response = $this->get('/registration');
        $response->assertStatus(200);
    }

    public function test2()
    {
        $response = $this->get('/registration');
        $response->assertSeeText('Регистрация');
    }

    public function test3()
    {
        $response = $this->get('/registration');
        $response->assertSee("Зарегистрироваться");
    }

    public function test4()
    {
        $response = $this->get('/registration');
        $response->assertSeeInOrder(['Пароль', 'Повторите пароль' ]);
    }

}
