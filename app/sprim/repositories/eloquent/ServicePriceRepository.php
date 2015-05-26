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

}