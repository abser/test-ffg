<?php

namespace Sprim\Model;

use Sprim\Repositories\Contracts\MemberInterface;
use LaravelBook\Ardent\Ardent;

class Member extends Ardent implements MemberInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';
    protected $guarded = ['id'];

}
