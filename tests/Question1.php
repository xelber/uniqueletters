<?php

use App\UniqueLetters;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Question1 extends TestCase
{

    public function testThis()
    {

        $this->assertTrue(UniqueLetters::check('documentarily'));
        $this->assertTrue(UniqueLetters::check('aftershock'));
        $this->assertTrue(UniqueLetters::check('countryside'));
        $this->assertTrue(UniqueLetters::check('six-year-old'));

        $this->assertFalse(UniqueLetters::check('Double-down'));
        $this->assertFalse(UniqueLetters::check('epidemic'));
        $this->assertFalse(UniqueLetters::check('eE'));
        $this->assertFalse(UniqueLetters::check('111eE'));
    }
}
