<?php namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Repositories\Contracts\ServiceInterface;
use Sprim\Repositories\Contracts\ServiceCategoryInterface as ServiceCategory;

use Sprim\Model\Service;
use Carbon\Carbon;

class ServiceRepository extends AbstractRepository implements ServiceInterface {

    protected $model;
    
    protected $fields = [
    		'name'      => 'services.name',
    		'service_category_id'	=> 'service_category_id'
    ];

    public function __construct(Service $model, ServiceCategory $service_category) {   	
    	
        $this->model			= $model;
        $this->service_category	= $service_category;

        parent::__construct();
    }


    public function filteredModel($s_term = null, $s_field = 'all', $country = null, $filter = null)
    {
    	// \DB::connection()->disableQueryLog();
    	// \DB::connection('mysql_sprim_dhs')->disableQueryLog();
    
    	$model = \DB::table('services')
    	->select(\DB::raw('services.id, services.name, services.description, services.status,
    	
    				DATE_FORMAT('.\Helpers::dateTz('services.created_at').', "'.$this->mysql_dt_format.'") AS created_date,
    				services.created_at
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
    				$model->where(\DB::raw('DATE_FORMAT('.\Helpers::dateTz('services.created_at').', "'.$this->mysql_dt_format.'")'),
    						'like', '%'.$s_term.'%');
    			} else {
    				$model->where($s_field, 'like', '%'.$s_term.'%');
    			}
    
    		} else {
    			$model->where('services.name', 'like', '%'.$s_term.'%');
    
    			foreach ($this->fields as $field)
    			{
    				$model->orWhere($field, 'like', '%'.$s_term.'%');
    			}
    			$model->orWhere(\DB::raw('DATE_FORMAT('.\Helpers::dateTz('services.created_at').', "'.$this->mysql_dt_format.'")'),
    					'like', '%'.$s_term.'%');
    		}
    	}
    
    	return $model;
    }
     
    public function fields($obj, $input = array())
    {    	
    	$obj->club_id           = \Helpers::keyInput('club_id', $input);
    	$obj->name              = \Helpers::keyInput('name', $input);
    	$obj->description       = \Helpers::keyInput('description', $input);
    	$obj->cancellation_notes= \Helpers::keyInput('cancellation_notes', $input);
    	$obj->cancellation_notice_period	= \Helpers::keyInput('cancellation_notice_period', $input);
    	$obj->ghcp_appointment	= \Helpers::keyInput('ghcp_appointment', $input);
    	$obj->only_ghcp			= \Helpers::keyInput('only_ghcp', $input);
    
    	$service_category_id	= ($obj->service_category_id)? $obj->service_category_id : null;
    
    	$obj->service_category_id	= $this->service_category->_save(\Helpers::keyInput('service_category', $input), $service_category_id);
    
    	return $obj;
    }
    
}