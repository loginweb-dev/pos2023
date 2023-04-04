<?php

use Illuminate\Http\Request;
use App\Events\NewMessage;
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


Route::prefix('business')->group(function () {
    Route::get('/id/{id}', function ($id) {
        $bussine = App\Business::where('id', $id)->with('locations')->first();
        return $bussine->locations;
    });

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

//rutas de chatbots
Route::prefix('chatbots')->group(function () {
    Route::get('/start/{id}', function ($id) {
        return App\Chatbots::where('busine_id', $id)->where('type', 'start')->first();
    });

    Route::get('/init/{id}', function ($id) {
        return App\Chatbots::where('busine_id', $id)->where('type', 'init')->first();
    });

    Route::post('/save', function (Request $request) {
        // return $request;
        App\Chatbots::create([
            'phone' => $request->phone,
            'message' => $request->message,
            'type' => $request->type,
            'busine_id' => $request->busine_id,
        ]);
        return App\Chatbots::where("phone", $request->phone)->get();
    });

    Route::get('/start/delete/{id}', function ($id) {
        return App\Chatbots::where('busine_id', $id)->where('type', 'start')->delete();
    });

    Route::post('/send', function (Request $request) {
        event(new NewMessage($request->message, $request->phone, $request->type, $request->busine));
    });


});
