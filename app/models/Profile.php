<?php

namespace Sprim\Model;

use LaravelBook\Ardent\Ardent;
use Carbon\Carbon;

class Profile extends Ardent {

	public $timestamps  = true;
	
	// protected $fillable = [];
	
	public function getFullNameAttribute()
	{
		return $this->attributes['first_name'] . ' ' . $this->attributes['last_name'];
	}
	
	public function getAvatarAttribute()
	{
		$this->file_type    = \Config::get('sprim.file_types');
		$this->owner_table  = \Config::get('sprim.tables.profile');
	
		$avatar = \DB::table('file_owners')
		->join('files', 'file_owners.file_id', '=', 'files.id')
		->where('file_owners.owner_id', '=', $this->attributes['id'])
		->where('file_owners.owner_table', '=', $this->owner_table)
		->where('files.file_type', '=', $this->file_type['avatar'])->first();
	
		if (!$avatar){
			$file = new \stdClass();
			$file->name         = 'img/no-photo.png';
			$file->description  = 'no-photo.png';
			$avatar     = $file;
		}
	
		return \Helpers::s3_photo($avatar->name);
	}
	
	public function user()
	{
		return $this->belongsTo('User');
	}
	
	public function address()
	{
		return $this->belongsTo('Sprim\Model\Address');
	}
	
	public function contacts()
	{
		return $this->hasMany('Sprim\Model\ProfileContact', 'user_id');
	}

}