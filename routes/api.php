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
Route::post('auth', 'Api\ApiAuthController@authenticate');
Route::post('register', 'Api\ApiAuthController@register');

Route::group(['middleware' => 'auth:api'], function() {
	Route::get('post', 'Api\ApiPostsController@store');
    Route::get('post', 'Api\ApiPostsController@index');
   	Route::get('mypost', 'Api\ApiPostsController@mypost');
   	Route::post('post', 'Api\ApiPostsController@store');
    Route::get('post/{post}', 'Api\ApiPostsController@show');
   	Route::post('post/{post}/like', 'Api\ApiLikesController@LikesAction');
});
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });
