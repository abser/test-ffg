<?php namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Repositories\Contracts\ServicePriceInterface;

use Sprim\Model\ServicePrice;
use Carbon\Carbon;

class ServicePriceRepository extends AbstractRepository implements ServicePriceInterface {

    protected $model;

    public function __construct(ServicePrice $model) {   	
    	
        $this->model = $model;

        parent::__construct();
    }

    public function _save($input, $_service_id)
    {
    	$this->model->where('service_id', '=', $_service_id)->delete();
    	    	    	    
    	foreach ($input as $row){  		
    		
    		if ( (isset($row[0]) && !empty($row[0])) ||  (isset($row[1]) && !empty($row[1])) ) {
    			
    			$model				= $this->model->newInstance();
    			$model->service_id	= $_service_id;
    			$model->duration	= $row[0];
    			$model->price		= $row[1];
    			$model->created_by	= \Session::get('user.id');
    			    			
    			if (!$model->save()){
    				return false;
    			} else {
    				return true;
    			}  
    		}		
    	}
    	
    	return true;
    	 
    }
}