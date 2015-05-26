<?php namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Repositories\Contracts\ServiceInterface;

use Sprim\Model\Service;
use Carbon\Carbon;

class ServiceRepository extends AbstractRepository implements ServiceInterface {

    protected $model;

    public function __construct(Service $model) {   	
    	
        $this->model = $model;

        parent::__construct();
    }

}