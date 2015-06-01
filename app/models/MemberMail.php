<?php

namespace Sprim\Model;

use Sprim\Repositories\Contracts\MemberMailInterface;
use LaravelBook\Ardent\Ardent;

class MemberMail extends Ardent implements MemberMailInterface {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'member_mail';
    protected $guarded = ['id'];

}
