<?php

namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\RegionInterface;
use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Model\Region;

class RegionRepository extends AbstractRepository implements RegionInterface
{

    protected $model;

    public function __construct(Region $model)
    {
        $this->model = $model;
    }

    public function getRegionId($region_name, $country_code) 
    { 
        if (empty($region_name))
            return;

        $region = $this->model->where('name', 'like', '%' . $region_name . '%')->
                where('country', '=', $country_code)->first();
        
        if ($region) {
            return $region->ID;
        }

        return false;
    }
    
    public function getListByCountry($country_code)
    {
        return $this->model->where('country', '=', $country_code)->rememberForever()->get(array('id','name'));
    }

}