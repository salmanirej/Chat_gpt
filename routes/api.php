<?php

use App\Http\Controllers\chatgptController;
use App\Http\Controllers\OpenAIController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Broadcast;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
 


Broadcast::routes(['middleware' => ['auth:sanctum']]);

Route::post('/broadcasting/auth', function (Request $request) {
    return Broadcast::auth($request);
});

Route::middleware('auth:api')->group( function (){
    Route::resource('messages', MessagesController::class );
 
   
});
Route::post('question', [chatgptController::class,"question"] );
Route::get('test', [chatgptController::class,"test"] );

 
    Route::post('/completion',  [OpenAIController::class,"generateText"]);
 