<?php

namespace Sprim\Repositories\Eloquent;

//use Sprim\Model\Services;
use Sprim\Model\PaUsers;
use Sprim\Repositories\Contracts\PaUsersInterface;

class PaUsersRepository extends AbstractRepository implements PaUsersInterface {

    protected $model;

    public function __construct(PaUser $model) {
        $this->model = $model;
    }

}