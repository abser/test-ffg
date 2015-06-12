<?php
use Sprim\Repositories\Contracts\UserInterface as User;
use Sprim\Repositories\Contracts\FileInterface as File;
use Sprim\Repositories\Contracts\FileOwnerInterface as FileOwner;

class HomeController extends BaseController {

	public function __construct(User $user, File $file, FileOwner $file_owner) 
    {
    	$this->user				= $user;
    	$this->file				= $file;
    	$this->file_owner		= $file_owner;
    	 
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
        	
        	$data['pics'] = [];
        	foreach ($data['items'] as $row) {        		
        		$data['pics'][$row->id]    = $this->file_owner->getFile($row->id, $this->owner_table, $this->file_type['avatar']);
        	}
        	        	       	
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
