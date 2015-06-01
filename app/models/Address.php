<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class Address extends Ardent {

    public $timestamps = false;
    protected $table = 'addresses';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    /* protected function getDateFormat()
      {
      return \Config::get('sprim.date_format.mysql');
      } */
    public static $rules = array(
    );
    public static $factory = array(
        'street' => 'string',
        'city' => 'string',
        'postal_code' => 'integer',
    );

    public function region() {
        return $this->belongsTo('Sprim\Model\Region', 'region_id', 'ID');
    }

    public function country() {
        return $this->belongsTo('Sprim\Model\Country', 'country_code', 'code');
    }

}
