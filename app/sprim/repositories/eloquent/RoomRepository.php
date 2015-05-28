<?php

namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\RoomInterface;
use Sprim\Repositories\Contracts\RoomServiceInterface as RoomService;
use Sprim\Repositories\Contracts\RoomConjunctInterface as RoomConjunct;
use Sprim\Model\Room;

class RoomRepository extends AbstractRepository implements RoomInterface {

    protected $model;
    
    protected $fields = [
    		'name'      => 'rooms.name'
    ];

    public function __construct(Room $model, RoomService $room_service, RoomConjunct $room_conjunct) {
        
        $this->model		= $model;
        $this->room_service	= $room_service;
        $this->room_conjunct= $room_conjunct;

        parent::__construct();
    }

    
    public function filteredModel($s_term = null, $s_field = 'all', $country = null, $filter = null)
    {
    	// \DB::connection()->disableQueryLog();
    	// \DB::connection('mysql_sprim_dhs')->disableQueryLog();
    
    	$model = \DB::table('rooms')
    		->select(\DB::raw('rooms.id, rooms.name,
    				 
    				DATE_FORMAT('.\Helpers::dateTz('rooms.created_at').', "'.$this->mysql_dt_format.'") AS created_date,
    				rooms.created_at
    		'));  	
    	
    	return $this->whereClause($model, $s_term, $s_field, $country, $filter);
    }  
    
    private function whereClause($model, $s_term = null, $s_field = 'all', $country = null, $filter = null)
    {    
    	if ($country){
    		$model->whereRaw('(addresses.country_code IN ('.$country.'))');
    	}
    		
    	if ($s_term){
    		if ($s_field != 'all'){
    			$s_field = $this->sqlField($s_field);
       
    			if ($s_field == 'created_at'){
    				$model->where(\DB::raw('DATE_FORMAT('.\Helpers::dateTz('clubs.created_at').', "'.$this->mysql_dt_format.'")'),
    						'like', '%'.$s_term.'%');
    			} else {
    				$model->where($s_field, 'like', '%'.$s_term.'%');
    			}
    
    		} else {
    			// $model->where(\DB::raw("clubs.name"), 'like', '%'.$s_term.'%');    			
    			$model->where('clubs.name', 'like', '%'.$s_term.'%');
    			 
    			foreach ($this->fields as $field)
    			{    
    				$model->orWhere($field, 'like', '%'.$s_term.'%');
    			}
    			$model->orWhere(\DB::raw('DATE_FORMAT('.\Helpers::dateTz('clubs.created_at').', "'.$this->mysql_dt_format.'")'),
    					'like', '%'.$s_term.'%');
    			
    			$model->orWhere('countries.name', 'like', '%'.$s_term.'%');
    			$model->orWhere('sprim_dhs.regions.name', 'like', '%'.$s_term.'%');
    		}
    	}
    
    	return $model;
    }
     
    public function fields($obj, $input = array())
    {
    	$obj->name              = \Helpers::keyInput('name', $input);
    	$obj->description       = \Helpers::keyInput('description', $input);
    	 
    	$address_id             = ($obj->address_id)? $obj->address_id : null;
    	 
    	$obj->address_id        = $this->address->_save(\Helpers::keyInput('address', $input), $address_id);
    	 
    	return $obj;
    }
   
}