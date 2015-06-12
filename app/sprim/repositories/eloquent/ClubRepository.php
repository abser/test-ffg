<?php

namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\ClubInterface;
use Sprim\Repositories\Contracts\AddressInterface as Address;
use Sprim\Model\Club;

class ClubRepository extends AbstractRepository implements ClubInterface {

    protected $model;
    
    protected $fields = [
    		'name'      => 'clubs.name'
    ];

    public function __construct(Club $model, Address $address) {
        
        $this->model	= $model;
        $this->address	= $address;

        parent::__construct();
    }

    
    public function filteredModel($s_term = null, $s_field = 'all', $country = null, $filter = null)
    {
    	// \DB::connection()->disableQueryLog();
    	// \DB::connection('mysql_sprim_dhs')->disableQueryLog();
    
    	$model = \DB::table('clubs')
    		->select(\DB::raw('clubs.id, clubs.name, clubs.description, clubs.status, 
    				addresses.street,
    				addresses.city,
    				addresses.postal_code,
    				sprim_dhs.countries.name AS country,
    				sprim_dhs.regions.name AS region,    				
    				 
    				DATE_FORMAT('.\Helpers::dateTz('clubs.created_at').', "'.$this->mysql_dt_format.'") AS created_date,
    				clubs.created_at
    		'))
    		->leftJoin('addresses', 'clubs.address_id', '=', 'addresses.id')
    		->leftJoin('sprim_dhs.countries', 'sprim_dhs.countries.code', '=', 'addresses.country_code')
    		->leftJoin('sprim_dhs.regions', 'sprim_dhs.regions.id', '=', 'addresses.region_id');  	
    	
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

    public function getSelectList()
    {
    	$init	= array('' => 'Select Club');
    	
    	$obj	= $this->model->where('status', '=', '1')->orderBy('name')->lists('name', 'id');
    	
    	$options= array_map(function($name) { return ucwords($name); }, $obj);
    	
    	// return array_merge($init,$options);
    	// return ($init + $options);
    	return array_replace($init,$options);
    }
}