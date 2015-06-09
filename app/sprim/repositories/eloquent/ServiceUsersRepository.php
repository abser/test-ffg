<?php

namespace Sprim\Repositories\Eloquent;

//use Sprim\Model\Services;
use Sprim\Model\ServiceUsers;
use Sprim\Repositories\Contracts\ServiceUsersInterface;

class ServiceUsersRepository extends AbstractRepository implements ServiceUsersInterface {

    protected $model;

    public function __construct(ServiceUsers $model) {
        $this->model = $model;
    }

}