<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class Club extends Ardent {
	
	public $timestamps  = true;
    // protected $fillable = array('name', 'address_id', 'description', 'status');
	// use SoftDeletingTrait;
		
	protected $dates = ['deleted_at'];
	
	protected function getDateFormat()
	{
		return \Config::get('sprim.date_format.mysql');
	}

	public static $rules = array(
		'name'			=> 'required|min:3|max:100',
		'address_id'	=> 'integer',		
		'status'		=> 'required|in:0,1'
	);  
    
    public function clubusers() {
    	return $this->hasMany('Sprim\Model\ClubUser');
    }
    
	public function address() 
    {
        return $this->belongsTo('Sprim\Model\Address');
    }
}