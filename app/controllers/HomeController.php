<?php
use Sprim\Repositories\Contracts\UserInterface as User;

class HomeController extends BaseController {

	public function __construct(User $user) 
    {
    	$this->user		= $user;
    	 
    	$this->owner_table = Config::get('sprim.tables.profile');
    	$this->sort      = 'first_name';
    	$this->dir       = 'asc';
    }  
    
	public function index()
	{
        $data['role']   = 'user';
        
        if (Session::get('user.is_member')) {
        	
        	$limit = 6;
        	
        	$query = $this->user->filteredModel(null, null, array(3,4,5));
        	 
        	$data['totalItems'] = count($query->get());
        	$data['items']		= $query->skip(0)->take($limit)->get();
        	       	
			return View::make('site.member.index', compact('data'));
        } else {
        	return View::make('admin.dashboard', compact('data'));
        }
	}
    
    public function admin()
	{
        $data['role']   = 'admin';
        
		return View::make('admin.dashboard', compact('data'));
	}
	    
}
