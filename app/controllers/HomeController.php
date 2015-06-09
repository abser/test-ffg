<?php
use Sprim\Repositories\Contracts\UserInterface as User;

class HomeController extends BaseController {

	public function __construct() 
    {
        
    }  
    
	public function index()
	{
        $data['role']   = 'user';
        
        if (Session::get('user.is_member')) {
			return View::make('site.member.index', compact('data'));
        } else {
        	return View::make('user.dashboard', compact('data'));
        }
	}
    
    public function admin()
	{
        $data['role']   = 'admin';
        
		return View::make('admin.dashboard', compact('data'));
	}
	    
}
