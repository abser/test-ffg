<?php

namespace Sprim\Repositories;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider
{

    public function register()
    {
        $models = ['User', 'UserGroup', 'Address', 'Country', 'Region', 'Club', 'ClubUser', 'ServiceCategory', 'Service', 'ServicePrice',
            'Member', 'UserProfile','ProfileContacts','PaUsers','MemberMail','Room', 'RoomService', 'RoomConjunct','ServiceUser','UserGroup'];

        foreach($models as $model)
        {
            $this->app->bind(
                'Sprim\Repositories\Contracts\\'.$model.'Interface', 'Sprim\Repositories\Eloquent\\'.$model.'Repository');
        }
        
    }
    
    /*
    public function provides()
    {
    	// $models = ['User', 'UserGroup'];
       	
    	return [
    			"Sprim\Repositories\Contracts\UserInterface",
    			"Sprim\Repositories\Contracts\UserGroupInterface",
    	];
    } */

}