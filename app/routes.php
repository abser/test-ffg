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
if (Sentry::check()) {
    $index = (Session::get('user.is_admin')) ? 'HomeController@admin' : 'HomeController@index';
} else {
    $index = 'AuthController@loginAction';
}

Route::any('/', ['uses' => $index, 'as' => 'index']);

Route::group(array("before" => "guest"), function() {
    Route::any("/login", array(
        "as" => "login",
        "uses" => 'AuthController@loginAction'
    ));

    Route::any("/request", array(
        "as" => "auth.request",
        "uses" => "AuthController@requestAction"
    ));

    Route::any("/reset", array(
        "as" => "auth.reset",
        "uses" => "AuthController@resetAction"
    ));

    Route::any("/user/activate/{id}/{code}", array(
        "as" => "auth.activate",
        "uses" => "AuthController@activateAction"
    ));
});

Route::group(array("before" => "sentry"), function() {
    Route::get("/feedback", array(
        "as" => "feedback",
        "uses" => "FeedbackController@formAction"
    ));

    Route::post("/feedback", array(
        "as" => "feedback",
        "uses" => "FeedbackController@submitAction"
    ));

    Route::any("/logout", array(
        "as" => "auth.logout",
        "uses" => "AuthController@logoutAction"
    ));

    Route::any("/change-password", array(
        "as" => "auth.change-password",
        "uses" => "AuthController@changePasswordAction"
    ));

    // Route::group(array("before" => "admin_user"), function()
    // {

    Route::group(array('prefix' => 'club'), function() {
        Route::any("/activate/{id}", array(
            "as" => "club.activate",
            "uses" => "ClubController@activateAction"
        ))->where(['id' => '[\d+]+']);

        Route::any("/deactivate/{id}", array(
            "as" => "club.deactivate",
            "uses" => "ClubController@deactivateAction"
        ))->where(['id' => '[\d+]+']);
    });
    Route::resource('club', 'ClubController');
    // Route::resource('club', 'ClubController', array('only' => array('index', 'show')));

    Route::group(array('prefix' => 'room'), function() {
        Route::any("/activate/{id}", array(
            "as" => "room.activate",
            "uses" => "RoomController@activateAction"
        ))->where(['id' => '[\d+]+']);

        Route::any("/deactivate/{id}", array(
            "as" => "room.deactivate",
            "uses" => "RoomController@deactivateAction"
        ))->where(['id' => '[\d+]+']);
    });
    Route::resource('room', 'RoomController');

    Route::group(array('prefix' => 'service'), function() {
        Route::any("/activate/{id}", array(
            "as" => "service.activate",
            "uses" => "ServiceController@activateAction"
        ))->where(['id' => '[\d+]+']);

        Route::any("/deactivate/{id}", array(
            "as" => "service.deactivate",
            "uses" => "ServiceController@deactivateAction"
        ))->where(['id' => '[\d+]+']);
    });
    Route::resource('service', 'ServiceController');

    Route::group(array('prefix' => 'wellness-team'), function() {
        Route::any("/activate/{id}", array(
            "as" => "wellness-team.activate",
            "uses" => "WellnessTeamController@activateAction"
        ))->where(['id' => '[\d+]+']);

        Route::any("/deactivate/{id}", array(
            "as" => "wellness-team.deactivate",
            "uses" => "WellnessTeamController@deactivateAction"
        ))->where(['id' => '[\d+]+']);
    });
    Route::resource('wellness-team', 'WellnessTeamController');
    // });


    Route::group(array('prefix' => 'member'), function() {
        Route::any("/activate/{id}", array(
            "as" => "member.activate",
            "uses" => "MemberController@activateAction"
        ))->where(['id' => '[\d+]+']);

        Route::any("/deactivate/{id}", array(
            "as" => "member.deactivate",
            "uses" => "MemberController@deactivateAction"
        ))->where(['id' => '[\d+]+']);
        Route::any("/message/{id}", array(
            "as" => "member.message",
            "uses" => "MemberController@messageAction"
        ))->where(['id' => '[\d+]+']);
        Route::any("/sendMessage", [
            "as" => "member.sendMessage",
            "uses" => "MemberController@sendMessage"]);
        Route::any("/messageBroadcast", [
            "as" => "member.messageBroadcast",
            "uses" => "MemberController@messageBroadcast"]);
        Route::any("/servicelist", [
            "as" => "member.servicelist",
            "uses" => "MemberController@servicelist"]);
    });
    Route::resource('member', 'MemberController');
    // });
    Route::group(array('prefix' => 'user'), function() {
        Route::any("/useractivate/{id}/{stat}", array(
            "as" => "user.useractivate",
            "uses" => "UserController@activateAction"
        ))->where(['id' => '[\d+]+']);

        Route::any("/userdeactivate/{id}/{stat}", array(
            "as" => "user.userdeactivate",
            "uses" => "UserController@deactivateAction"
        ))->where(['id' => '[\d+]+']);

        Route::any("/useractive/{id}/{stat}", array(
            "as" => "user.activ",
            "uses" => "UserController@activateAction"
        ))->where(['id' => '[\d+]+']);

        Route::any("/getAccessDiv", [
            "as" => "user.getAccessDiv",
            "uses" => "UserController@getAccessDiv"]);
    });
    Route::resource('user', 'UserController');
});

Route::get('api/regions/{country_code}', function($country_code) {
    $region = App::make('Sprim\Repositories\Contracts\RegionInterface');
    return $region->getListByCountry($country_code);
});

Route::get('api/services_sub_category/{category_id}', function($category_id) {
    $service_sub_category = App::make('Sprim\Repositories\Contracts\ServiceCategoryInterface');
    return $service_sub_category->getListByServiceCategory($category_id);
});

