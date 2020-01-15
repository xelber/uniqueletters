<?php

use App\StringMerger;
use App\UniqueLetters;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Question2 extends TestCase
{

    public function testThis()
    {

        $this->assertEquals('a1b2c3', StringMerger::merge('abc', '123'));
        $this->assertEquals('a1b2c3d', StringMerger::merge('abcd', '123'));
        $this->assertEquals('a1b23', StringMerger::merge('ab', '123'));
        $this->assertEquals('', StringMerger::merge('', ''));
        $this->assertEquals('1', StringMerger::merge('1', ''));
        $this->assertEquals('1', StringMerger::merge('', '1'));
        $this->assertEquals('-1-1--', StringMerger::merge('----', '11'));
    }
}
