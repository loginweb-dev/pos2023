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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//rutas de productos
Route::prefix('productos')->group(function () {
    Route::get('/id/{id}', function ($id) {
        $producto = App\Product::find($id);
        return $producto;
    });

});

//rutas de productos
Route::prefix('extras')->group(function () {
    Route::get('/get/{id}', function ($id) {
        $extras = App\Product::where('business_id', $id)->where('category_id', 3)->get();
        return $extras;
    });

});
