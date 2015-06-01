<?php namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Repositories\Contracts\ServiceCategoryInterface;

use Sprim\Model\ServiceCategory;
use Carbon\Carbon;

class ServiceCategoryRepository extends AbstractRepository implements ServiceCategoryInterface {

    protected $model;

    public function __construct(ServiceCategory $model) {   	
    	
        $this->model = $model;

        parent::__construct();
    }

    public function _save($input, $_service_category_id = null)
    {
    	if ($_service_category_id){
    		$service_category = $this->find($_service_category_id);    		
    	} else {
    		$service_category		= new $this->model;
    		$service_category->name	= \Helpers::keyInput('service_category', $input);    		
    		$service_category->created_by 	= \Session::get('user.id');
    	}
    	$service_category->parent_id	= 0;
    	  
    	if($service_category->save()){
    
    		return $service_category->id;
    	}
    
    }
    
    public function _saveSubCategory($input, $_service_category_id, $_sub_category_id = null)
    {
    	if ($_sub_category_id){
    		$service_category = $this->find($_sub_category_id);    		
    	} else {
    		$service_category		= new $this->model;
    		$service_category->name	= \Helpers::keyInput('service_sub_category', $input);    		
    		$service_category->created_by 	= \Session::get('user.id');
    	}
    	$service_category->parent_id	= $_service_category_id;
    	 
    	if($service_category->save()){
    
    		return $service_category->id;
    	}
    
    }
    
    public function getSelectList($_level = 0, $with_select = true)
    {
    	if ($with_select) {
    		$init	= ($_level == 0)?array('' => 'Select Category'):array(''=>'Select Sub-Category');
    	} else {
    		$init = array();
    	}
    	 
    	$obj	= $this->model->where('parent_id', '=', $_level)->orderBy('name')->lists('name', 'id');
    	 
    	$options= array_map(function($name) { return ucwords($name); }, $obj);
    	 
    	// return array_merge($init,$options);
    	return array_replace($init,$options);
    }
}