<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function () {
    $host = env('FIREBIRD_HOST');
    $database = env('FIREBIRD_DATABASE');
    $username = env('FIREBIRD_USERNAME');
    $password = env('FIREBIRD_PASSWORD');
    
    $pdo = new PDO("firebird:host=$host;dbname=$database;charset=utf8", $username, $password);

    $statement = $pdo->prepare('SELECT * FROM N01_VAIR');
    $statement->execute();
    $results = $statement->fetchAll(PDO::FETCH_ASSOC);

    // print_r(mb_list_encodings());

    $data = mb_convert_encoding($results, 'UTF-8', 'ISO-8859-13');
    // return $data;
    return response()->json($data);
});
