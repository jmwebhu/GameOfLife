<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

use App\Board\Board;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/nextGeneration', function (Request $request) {
    $matrix = $request->input('matrix');
    $board = new Board;
    $board->setMatrix($matrix);
    $nextGeneration = $board->nextGeneration();

    return json_encode($nextGeneration);
});

