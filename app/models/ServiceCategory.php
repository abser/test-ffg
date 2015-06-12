<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class ServiceCategory extends Ardent {
	
    // protected $fillable = array('name', 'parent_id');

	public static $rules = array(
		'name'		=> 'required|min:3|max:100',
		'parent_id'	=> 'integer'
	);
    
    /* public static function boot()
    {
        parent::boot();
        
        // Attach event handler, on deleting of the user
        Agent::creating(function($model)
        {   
            $model->created_by = \Session::get('user.id');
        });
    } */    
    
    public function services() {
    	return $this->hasMany('Sprim\Model\Service');
    }
}