<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/question6', function () {
    $content = file_get_contents(storage_path('sample-reaxml.xml'));
    $parser = new \App\XmlParser($content);
    $csv = $parser->getAsCsv();

    $buffer = fopen('php://temp', 'r+');

    foreach ($csv as $line) {

        fputcsv($buffer, $line, ',');

    }
    rewind($buffer);

    header('Content-Type: application/csv');

    header('Content-Disposition: attachment; filename="properties.csv";');
    fpassthru($buffer);
});