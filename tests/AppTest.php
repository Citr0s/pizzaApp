<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AppTest extends TestCase
{
    public function test_loading_the_app()
    {
        $this->visit('/')->see('Welcome');
    }
}
