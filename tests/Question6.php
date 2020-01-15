<?php

use App\StringMerger;
use App\UniqueLetters;
use App\XmlParser;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class Question6 extends TestCase
{

    public function testThis()
    {
        $content = file_get_contents(storage_path('sample-reaxml.xml'));
        $parser = new XmlParser($content);
        $csv = $parser->getAsCsv();

        $buffer = fopen('php://temp', 'r+');

        foreach ($csv as $line) {

            fputcsv($buffer, $line, ',');

        }
        rewind($buffer);
        $csv = stream_get_contents($buffer);
        fclose($buffer);
        echo $csv;
        //print_r($csv);
    }
}
