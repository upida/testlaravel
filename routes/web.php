<?php

use App\Models\Repositories;
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

Route::get('/repositories', function() {
    $repositories = Http::get('https://api.github.com/repositories')->body();

    $insert = array_map(function($data) {
        return [
            'id' => $data['id'],
            'full_name' => $data['full_name'],
            'owner_login' => $data['owner']['login'],
        ];
    }, json_decode($repositories, true));

    Repositories::insert($insert);

    return response($insert);
});
