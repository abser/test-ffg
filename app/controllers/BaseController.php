<?php

class BaseController extends Controller {

	protected $contact_type;   
    
    protected $s3_conf;
    protected $file_type;
    protected $owner_table;
    protected $p_sort;
    protected $p_dir;
    protected $p_s_field;
    protected $p_s_term;
    protected $country;
    protected $base_url;
    protected $s3;
	
	public function __construct() {
		$this->file_type        = Config::get('sprim.file_types');
		$this->contact_type     = Config::get('sprim.contact_types');
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

	
	protected function downloadFile($file)
	{
		$error_msg  = 'There is a problem with the file and cannot be downloaded.
            Please ask the owner to upload it again.';
	
		$s3_file    = Helpers::s3_file($file->name);
	
		if (!file_exists($file->name) && !$s3_file){
			Session::flash('error', $error_msg);
			return Redirect::back();
		}
	
		if ($s3_file){
			$file_name = $s3_file;
		} else {
			$file_name = $file->name;
		}
	
		try
		{
			$file_url = $file_name;
	
			header("Content-Transfer-Encoding: Binary");
			header("Content-disposition: attachment; filename=\"" . $file->description . "\"");
			if (ob_get_length()) ob_end_clean();
			flush();
			readfile($file_url);
		}
		catch (Exception $e)
		{
			Session::flash('error', $error_msg);
			return Redirect::back();
		}
	}
}
