<?php

namespace Sprim\Composers;

class CountryAllList
{

    public function __construct(\Sprim\Repositories\Contracts\CountryInterface $country)
    {
        $this->country = $country;
    }

    public function compose($view)
    {
        $init      = array('' => '');
    
        $obj = $this->country->cachedList();

        $options        = array_map(function($name) { return ucwords($name); }, $obj);
        $countries_menu = array_merge($init,$options);

        $view->with('countries', $countries_menu);
    }

}