<?php

namespace Sprim\Model;

use Sprim\Repositories\Contracts\UserGroupInterface;
use LaravelBook\Ardent\Ardent;

class UserGroup extends Ardent implements UserGroupInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_groups';
    protected $guarded = ['id'];
    public $timestamps = false;

}
