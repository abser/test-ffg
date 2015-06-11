<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class ClubUser extends Ardent {

   // protected $guarded = array();
    protected $fillable = array('club_id', 'user_id', 'type', 'status','created_by');

    public function club() {
        return $this->belongsTo('Sprim\Model\Club');
    }

}
