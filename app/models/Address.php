<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;

class Address extends Ardent {
    
    public $timestamps  = false;
    protected $table    = 'addresses';

    public static $rules = array(
    );
    
    public static $factory = array(
        'street'        => 'string',
        'city'          => 'string',
        'postal_code'   => 'integer',
    );
    
    public function region() 
    {
        return $this->belongsTo('Sprim\Model\Region', 'region_id', 'ID');
    }
    
    public function country() 
    {
        return $this->belongsTo('Sprim\Model\Country', 'country_code', 'code');
    }
}