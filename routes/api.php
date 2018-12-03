<?php

use Illuminate\Http\Request;
use App\Exports\TodoExport;

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

Route::middleware('auth:api')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    
    Route::get('/userProfile', 'AuthController@show');
    Route::get('/rules', 'AuthController@rules');
    Route::get('/todos', 'TodosController@index');
    Route::post('/todos', 'TodosController@store');
    Route::patch('/todos/{todo}', 'TodosController@update');
    Route::delete('/todos/{todo}', 'TodosController@destroy');

    Route::post('/logout', 'AuthController@logout');
});

Route::post('/login', 'AuthController@login');
Route::post('/register', 'AuthController@register');

Route::group([    
    'namespace' => 'Auth',    
    'middleware' => 'api',    
    'prefix' => 'password'
], function () {    
    Route::post('create', 'PasswordResetController@create');
    Route::get('find/{token}', 'PasswordResetController@find');
    Route::post('reset', 'PasswordResetController@reset');
});

