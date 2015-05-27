<?php

namespace Sprim\Composers;

use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function register()
    {
       
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
    	$this->app->view->composer(['common.country'] ,
    			'Sprim\Composers\CountryAllList');
    	
    	/* $this->app->view->composer(['common.country'] ,
    			'Sprim\Composers\RegionList'); */
    }

}