<?php

use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', 'WelcomeController@index');

Route::get('/', 'HomeController@index');

Route::get('/sintegra/home', 'SintegraController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

resource('sintegra', 'SintegraController');

get('sintegra/cnpj/{cnpj}',	[
	'as' => 'getConsulta',	'uses' => 'SintegraController@getConsulta'
]);
