<?php namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\AddressInterface;
use Sprim\Repositories\Contracts\CountryInterface as Country;
use Sprim\Repositories\Contracts\RegionInterface as Region;
use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Model\Address;

class AddressRepository extends AbstractRepository implements AddressInterface {

    protected $model;
    protected $country;
    protected $region;
    public $allow_null = true;

    public function __construct(Address $model, Country $country, Region $region)
    {
        $this->model    = $model;
        $this->country  = $country;
        $this->region   = $region;
    }
    
    public function _save($input, $_address_id = null)
    {
        if ($_address_id){ 
            $address = $this->find($_address_id);
        } else {
            $address = new $this->model;
        } 
        
        $region_id              = null;
        $country_code           = null;
                      
        if (array_key_exists('country_code', $input)){
            $country_code           = \Helpers::keyInput('country_code', $input);
        } else if (array_key_exists('country_name', $input)){
            $country_code           = $this->country->getCountryCode($input['country_name']);
        }

        if (array_key_exists('region_id', $input)){
            $region_id         = \Helpers::keyInput('region_id', $input);
        } else if (array_key_exists('region_name', $input)){
            $region_id         = $this->region->getRegionId($input['region_name'], $country_code);
        }

        $address->address1      = \Helpers::keyInput('address1', $input);
        $address->address2      = \Helpers::keyInput('address2', $input);
        $address->street        = \Helpers::keyInput('street', $input);
        $address->city          = \Helpers::keyInput('city', $input);
        $address->postal_code   = \Helpers::keyInput('postal_code', $input);
        $address->region_id     = $region_id;
        $address->country_code  = $country_code;

        /* if(!$this->allow_null){
        	$address = $this->keepOldData($address);
        } */
        
        if($address->save()){
            
            return $address->id;
        }

    }
    
    public function getDistinctCountries()
    {
        $countries = false;
        
        if(\Session::get('user.is_admin')){
            $countries          = $this->model->all()->groupBy('country_code')->toArray();
        } elseif (\Session::get('user.countries')){
            $countries          = $this->model->whereIn('country_code', \Session::get('user.countries'))->get()->groupBy('country_code')->toArray();
        }
        
        if(!$countries){
            return null;
        }
        
        return $this->country->getNamesInList(array_keys($countries));
    }
    
}