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

    public function getSelectList()
    {
    	$init	= array('' => '');
    	 
    	$obj	= $this->model->orderBy('name')->lists('name', 'id');
    	 
    	$options= array_map(function($name) { return ucwords($name); }, $obj);
    	 
    	return array_merge($init,$options);
    }
}