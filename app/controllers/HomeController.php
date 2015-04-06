<?php
use Sprim\Repositories\Contracts\UserInterface as User;

class HomeController extends BaseController {

	public function __construct() 
    {
        
    }  
    
	public function index()
	{
        $data['role']   = 'user';
        
		return View::make('site.landing', compact('data'));
	}
    
    public function admin()
	{
        $data['role']   = 'admin';
        
		return View::make('site.landing', compact('data'));
	}
	    
}
