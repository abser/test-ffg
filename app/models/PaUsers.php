<?php

namespace Sprim\Model;

use Sprim\Repositories\Contracts\PaUsersInterface;
use LaravelBook\Ardent\Ardent;

class PaUsers extends Ardent implements PaUsersInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pa_users';
    protected $guarded = ['id'];

}
