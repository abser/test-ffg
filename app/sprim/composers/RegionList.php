<?php

namespace Sprim\Composers;

class RegionList
{

    public function __construct(\Sprim\Repositories\Contracts\GeoRegionInterface $region)
    {
        $this->region = $region;
    }

    public function compose($view)
    {
        
        $obj = $this->region->getList('code', 'name');
        $obj[0] = '';
        ksort($obj);
        
        $view->with('regions', $obj);
    }

}