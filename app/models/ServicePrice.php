<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class ServicePrice extends Ardent {
	
    // protected $fillable = array('service_id', 'duration', 'price');

	public static $rules = array(
		'service_id'	=> 'required|integer',			
		'duration'		=> 'integer',
		'price'			=> 'numeric'
	);  
    
    public function services() {
    	return $this->belongsTo('Sprim\Model\Service');
    }
}