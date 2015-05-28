<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class Region extends Ardent {

    protected $connection   = 'mysql_sprim_dhs';
    protected $guarded      = array();
    public $timestamps      = false;
    
    public static $rules    = array(
        'name' => 'required'
    );

    public function country() 
    {
        return $this->belongs_to('Sprim\Model\Country', 'country');
    }
}