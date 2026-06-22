<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookControllerApi;

Route::middleware('apikey')->group(function () {

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

/*
| This function I used for protect my route api
| 
 */

/**
 * This is example for using route api protecte with apikey and scops of api
 */


    // Route::get('/products', function () {
    // return 'Read products!';
    // })->middleware('apikey:read');

    // Route::post('/products', function () {
    //     return 'Create product!';
    // })->middleware('apikey:write');

    // Route::patch('/products/{id}', function () {
    //     return 'Update product!';
    // })->middleware('apikey:write');

    // Route::delete('/products/{id}', function () {
    //     return 'Delete product!';
    // })->middleware('apikey:delete');


    Route::get('books', [BookControllerApi::class, 'index'])->middleware('apikey:read');
    Route::post('books', [BookControllerApi::class, 'store'])->middleware('apikey:write');
    Route::patch('books/{id}', [BookControllerApi::class, 'update'])->middleware('apikey:write');
    Route::delete('books/{id}', [BookControllerApi::class, 'destroy'])->middleware('apikey:delete');
    

    Route::get('borrowers', [BookControllerApi::class, 'index']);

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });

    



















});