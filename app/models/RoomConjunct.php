<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class RoomConjunct extends Ardent {
	
	public $timestamps  = true;
   		
	protected $dates = ['deleted_at'];
		    
    public function room() {
    	return $this->belongsTo('Sprim\Model\Room');
    }

}