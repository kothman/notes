<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class HomeTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testHomeContent()
    {
        $this->visit('/')
            ->see('Note-Taker')
            ->see('E-Mail')
            ->see('Password')
            ->see('Login');
    }

    public function testProtectedUserRoutes()
    {
        $this->visit('/')
            ->seePageIs('/login');
    }
}
