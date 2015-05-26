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

}