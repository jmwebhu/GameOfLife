<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Board;

Route::get('/', function () {
    $matrix = [
        [1, 1, 0],
        [0, 0, 0],
        [1, 1, 1]
    ];
    $board = new Board();
    $board->setMatrix($matrix);
    $board->nextGeneration();
});
