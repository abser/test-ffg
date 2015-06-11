<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class ClubUser extends Ardent {

    protected $guarded = array();

    public function club() {
        return $this->belongsTo('Sprim\Model\Club');
    }

}
