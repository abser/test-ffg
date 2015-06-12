<?php namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\GeoRegionInterface;
use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Model\GeoRegion;

class GeoRegionRepository extends AbstractRepository implements GeoRegionInterface {

    protected $model;

    public function __construct(GeoRegion $model)
    {
        $this->model = $model;
    }
    
    public function getList()
    {
        return $this->model->orderBy('name')->lists('name', 'id');
    }
}