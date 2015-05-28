<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class Room extends Ardent {
	
	public $timestamps  = true;
   		
	protected $dates = ['deleted_at'];
	
	public static $rules = array(
		'name'			=> 'required|min:3|max:100',
		'status'		=> 'required|in:0,1'
	);  
    
    public function room_services() {
    	return $this->hasMany('Sprim\Model\RoomService');
    }

}