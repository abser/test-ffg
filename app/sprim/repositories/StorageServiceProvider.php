<?php

namespace Sprim\Repositories;

use Illuminate\Support\ServiceProvider;

class StorageServiceProvider extends ServiceProvider
{

    public function register()
    {
        $models = ['User', 'UserGroup'];
        
        foreach($models as $model)
        {
            $this->app->bind(
                'Sprim\Repositories\Contracts\\'.$model.'Interface', 'Sprim\Repositories\Eloquent\\'.$model.'Repository');
        }
        
    }

}