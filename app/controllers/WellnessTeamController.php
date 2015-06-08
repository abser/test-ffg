<?php

use Sprim\Repositories\Contracts\UserInterface as User;
use Sprim\Repositories\Contracts\ServiceInterface as Service;
use Sprim\Repositories\Contracts\ClubInterface as Club;
use Sprim\Repositories\Contracts\ServiceCategoryInterface as ServiceCategory;
use Sprim\Repositories\Contracts\UserProfileInterface as UserProfile;

class WellnessTeamController extends \BaseController {

	public function __construct(User $user, Service $service, ServiceCategory $service_category, Club $club, UserProfile $user_profile)
	{
		$this->model	= $user;
		$this->user		= $user;
		$this->service	= $service;
		$this->club		= $club;
		$this->service_category = $service_category;
		$this->user_profile		= $user_profile;
	
		parent::__construct();
		$this->owner_table = Config::get('sprim.tables.service');
		$this->sort      = 'first_name';
		$this->dir       = 'asc';
	
		$this->route_prefix = 'wellness-team';
	}
	
	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$data			= $this->getList();
		$data['route']  = 'wellness-team.index';
		
		return View::make("wellness-team.index", compact('data'));
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		$data					= $this->initData();
		$data['clubs']			= $this->club->getSelectList();
		$data['categories']		= $this->service_category->getSelectList(0);
		$data['sub_categories']	= $this->service_category->getSelectList(1);
		
		return View::make($this->route_prefix.'.create', compact('data'));
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		$input		= Input::all();
		$password   = $this->user->getRandomPassword(); //  strval(rand(11111111, 99999999));
		
		$input['password']	= $password;
		$user				= $this->user->newInstance();
		$user	            = $this->user->fields($user, $input);		
					
		if (!$user->validate()){
			return Redirect::route($this->route_prefix.'.create')->withErrors($user->errors())->withInput();
		} else {			
			try {
				$user = Sentry::register(array('email' => $user->email,
						'password'      => $user->password,
						'first_name'    => $user->first_name,
						'last_name'     => $user->last_name,
						'title'			=> $user->title,));
	
				/* $data['activationCode']     = $user->GetActivationCode();
				$data['email']              = $inputUser['email'];
				$data['userId']             = $user->getId();
				$data['password']           = $password;
	
				Mail::send('emails.auth.welcome', $data, function($m) use($data)
				{
					$m->to($data['email'])->subject(Config::get('sprim.site_name'));
				}); */
	
				$allGroups   = Sentry::getGroupProvider()->findAll();
				// $permissions = $this->permissions;
	
				foreach ($allGroups as $group) {
						
					if ($group->id == 3)
					{
						$user->addGroup($group);
					}
				}
				
				$this->user_profile->_save($input);	
				// $this->saveOtherDetails($user, Input::all());
	
				Session::flash('success', 'New user has been created');
				return Redirect::route($this->route_prefix.'.index');
	
			}
			catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
			{
				Session::flash('error', 'Login field required.');
				return Redirect::route($this->route_prefix.'.create')->withErrors($v)->withInput();
			}
			catch (Cartalyst\Sentry\Users\UserExistsException $e)
			{
				Session::flash('error', 'User already exists.');
				return Redirect::route($this->route_prefix.'.create')->withErrors($v)->withInput();
			}
		}
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$data                           = $this->initData();
		$data['user']                   = $this->user->getById($id);
		$data['sentry']                 = Sentry::findUserById($id);
		$data['user_groups']    = array();
		$data['email_opt']      = 'disabled';
		
		foreach ($data['sentry']->groups as $group){
			$data['user_groups'][] = $group->id;
		}	
		
		$data['clubs']		= $this->club->getSelectList();
		$data['categories']	= $this->service_category->getSelectList(0);
		$data['sub_categories']	= $this->service_category->getSelectList(1);
		
		if(!$data['user']){
			return Response::view('errors.404', array(), 404);
		}
		
		return View::make('wellness-team.edit', compact('data'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		/* $input  = Input::all();
		$model  = $this->model->fields($this->model->find($id), $input);
		$model->updated_by 	= \Session::get('user.id');
		
		if (!$model->save()){
			return Redirect::to('service/create')->withErrors($model->errors())->withInput();
		} else {
				
			$this->model->saveRelations($model, $input);
				
			return Redirect::to('service');
		} */
			
		$input      = Input::all();
		$user       = Sentry::findUserById($id);
		$groups		= Sentry::findAllGroups();
		$input['permissions'] = Utils::filterArray(Input::get('permissions', null));
		
		/* foreach($groups as $group){
			$user->removeGroup($group);
		}
		
		if($input['permissions']){		
			foreach($input['permissions'] as $key => $val){
				$group = Sentry::findGroupById($key);
				$user->addGroup($group);
			}
		} */
		
		$user->first_name   = $input['first_name'];
		$user->last_name    = Helpers::keyInput('last_name', $input);
		
		if (!$user->save()){
			return Redirect::route('wellness-team.edit', $id)->withErrors($user->errors())->withInput();
		} else {
			// $this->saveOtherDetails($user, $input);
			return Redirect::to('wellness-team');
		}
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


	protected function getList()
	{
		$pageParams         = Helpers::paginatorParams($this->sort, $this->dir);
		$data               = $pageParams;
		$data['r_prefix']   = 'wellness-team';
		$data['s_fields']   = array('all' => 'All', 'name' => 'Service Name', 'service_category' => 'Service Category');
	
		$obj                = $this->model->paginate($pageParams);
		$data['model']      = Paginator::make($obj->items, $obj->totalItems, $pageParams['limit']);
	
		$data['controller']     = 'wellness-team';
		return $data;
	}
	
	private function initData()
	{
		$data['groups']         = Sentry::getGroupProvider()->createModel()->orderBy('name')->get();
		if (!Session::get('user.is_admin')){
			foreach($data['groups'] as $key => $role)
			{
				if($role->id == 1){
					unset($data['groups'][$key]);
				}
			}
		}
	
		$data['email_opt']      = '';
	
	
		return $data;
	}
	
	protected function saveOtherDetails($user, $input)
	{	
		$user_model = $this->user->find($user->id);
		if (count($user_model->profile)){
			$user_model->profile_id = $user_model->profile->id;
		}
	
		$profile_id = $this->profile->_save($user_model, $input['profile']);
	
		if ($profile_id && $this->is_agent){
			$input = ['profile_id' => $profile_id];
			$this->agent->_save($input);
		}
	}
		
}
