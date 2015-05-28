<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class Service extends Ardent {
	
    /* protected $fillable = array('club_id', 'name', 'service_category_id', 'service_sub_category_id', 
    		'description', 'cancellation_notes', 'cancellation_notice_period', 'ghcp_appointment', 'only_ghcp'); */

	public static $rules = array(
		'club_id'		=> 'required|integer',
		'name'			=> 'required|min:3|max:100',	
		// 'service_category_id'	=> 'required|in:1,2,3',	
		'cancellation_notice_period'	=> 'numeric',
		'ghcp_appointment'	=> 'integer',
		'only_ghcp'			=> 'integer'
	);  
    
    public function service_categories() {
    	return $this->belongsTo('Sprim\Model\ServiceCategory');
    }
}