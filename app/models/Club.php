<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;

class Club extends Ardent {
	
    protected $fillable = array('name', 'address_id', 'description', 'status');

	public static $rules = array(
		'name'			=> 'required|min:3|max:100',
		'address_id'	=> 'integer',		
		'status'		=> 'required|in:0,1'
	);  
    
    public function clubusers() {
    	return $this->hasMany('Sprim\Model\ClubUser');
    }
}