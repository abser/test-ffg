<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;

class Country extends Ardent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected   $table          = 'countries';
    protected   $connection     = 'mysql_sprim_dhs';
    public      $primaryKey     = 'code';
    public      $timestamps     = false;
    
    
    public function regions(){
        return $this->hasMany('Sprim\Model\Region', 'country');
    }
}