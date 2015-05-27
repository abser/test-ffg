<?php

class BaseController extends Controller {

	/* protected $file_type;
	protected $contact_type;	
	protected $owner_table;
	protected $p_sort;
	protected $p_dir;
	protected $p_s_field;
	protected $p_s_term;
	protected $country;
	protected $base_url;
	protected $s3_conf;
	protected $s3; */
	
	public function __construct() {
		// $this->file_type        = Config::get('sprim.file_types');
		// $this->contact_type     = Config::get('sprim.contact_types');
	}
	
	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
