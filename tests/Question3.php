<?php

use App\StringMerger;
use App\UniqueLetters;
use App\XmlParser;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Question3 extends TestCase
{

    public function testThis()
    {
        $content = file_get_contents(storage_path('sample-reaxml.xml'));
        $parser = new XmlParser($content);

        $this->assertEquals($content, $parser->xmlContent);
        $this->assertArrayHasKey('1P3115', $parser->getList());
        $this->assertArrayHasKey('2631096', $parser->getList());
    }
}
