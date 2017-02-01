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
use App\Generation;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/generation/next', function (Request $request) {
    $matrix = $request->input('matrix');
    $board = new Board;
    $board->setMatrix($matrix);
    $nextGeneration = $board->nextGeneration();

    return json_encode($nextGeneration);
});

Route::post('/generation/save', function (Request $request) {
    $matrix = $request->input('matrix');
    $generation = new Generation;
    $generation->name = $request->input('name');
    $generation->states = json_encode($matrix);

    $generation->save(); 
});

