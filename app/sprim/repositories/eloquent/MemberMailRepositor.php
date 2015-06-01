<?php

namespace Sprim\Repositories\Eloquent;

//use Sprim\Model\Services;
use Sprim\Model\MemberMail;
use Sprim\Repositories\Contracts\MemberMailInterface;

class MemberMailRepositor extends AbstractRepository implements MemberMailInterface {

    protected $model;

    public function __construct(MemberMail $model) {
        $this->model = $model;
    }

}