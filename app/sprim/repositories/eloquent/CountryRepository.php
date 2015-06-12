<?php

namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\CountryInterface;
use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Model\Country;

class CountryRepository extends AbstractRepository implements CountryInterface
{

    protected $model;

    public function __construct(Country $model)
    {
        $this->model = $model;
    }

    public function getCountryCode($country_name)
    {
        if (empty($country_name))
            return;

        $country = $this->model->where('name', 'like', '%' . $country_name . '%')->first();
        
        if ($country) {
            return $country->code;
        }

        return FALSE;
    }
    
    public function cachedList()
    {
        return $this->model->orderBy('name')->rememberForever()->lists('name', 'code');
    }
    
    public function getNamesInList($array)
    {
        return $this->model->orderBy('name')->whereIn('code', $array)->lists('name', 'code');
    }
}