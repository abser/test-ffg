<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
if(Sentry::check()) {
	$index = (Session::get('user.is_admin'))? 'HomeController@admin' : 'HomeController@index';
} else {
	$index = 'AuthController@loginAction';
}

Route::any('/', ['uses' => $index, 'as' => 'index']);

Route::group(array("before" => "guest"), function()
{
	Route::any("/login", array(
		"as"   => "login",
		"uses" => 'AuthController@loginAction'
	));

	Route::any("/request", array(
		"as"   => "auth.request",
		"uses" => "AuthController@requestAction"
	));

	Route::any("/reset", array(
		"as"   => "auth.reset",
		"uses" => "AuthController@resetAction"
	));

	Route::any("/user/activate/{id}/{code}", array(
		"as"   => "auth.activate",
		"uses" => "AuthController@activateAction"
	));
});

Route::group(array("before" => "sentry"), function()
{
	Route::get("/feedback", array(
		"as"   => "feedback",
		"uses" => "FeedbackController@formAction"
	));

	Route::post("/feedback", array(
		"as"   => "feedback",
		"uses" => "FeedbackController@submitAction"
	));

	Route::any("/logout", array(
		"as"   => "auth.logout",
		"uses" => "AuthController@logoutAction"
	));

	Route::any("/change-password", array(
		"as"   => "auth.change-password",
		"uses" => "AuthController@changePasswordAction"
	));
	
	// Route::group(array("before" => "admin_user"), function()
	// {
	
	Route::group(array('prefix' => 'club'), function()
	{
		Route::any("/activate/{id}", array(
			"as"   => "club.activate",
			"uses" => "ClubController@activateAction"
		))->where(['id'=>'[\d+]+']);
	
		Route::any("/deactivate/{id}", array(
			"as"   => "club.deactivate",
			"uses" => "ClubController@deactivateAction"
		))->where(['id'=>'[\d+]+']);	
	});
	Route::resource('club', 'ClubController');
	// Route::resource('club', 'ClubController', array('only' => array('index', 'show')));
	
	
	Route::resource('service', 'ServiceController');
	// });
	
	
});

Route::get('api/regions/{country_code}', function($country_code){
	$region = App::make('Sprim\Repositories\Contracts\RegionInterface');
	return $region->getListByCountry($country_code);
});
