<?php

use Sprim\Repositories\Contracts\UserInterface as User;
use Sprim\Repositories\Contracts\ServiceInterface as Service;
use Sprim\Repositories\Contracts\ClubInterface as Club;
use Sprim\Repositories\Contracts\ServiceCategoryInterface as ServiceCategory;
use Sprim\Repositories\Contracts\ProfileInterface as Profile;
use Sprim\Repositories\Contracts\ProfileContactInterface as ProfileContact;

class WellnessTeamController extends \BaseController {

	public function __construct(User $user, Service $service, ServiceCategory $service_category, Club $club, UserProfile $user_profile, 
			Profile $profile, ProfileContact $profile_contact)
	{
		$this->model	= $user;
		$this->user		= $user;
		$this->service	= $service;
		$this->club		= $club;
		$this->service_category = $service_category;
		$this->user_profile		= $user_profile;
		
		$this->profile	= $profile;
		$this->profile_contact	= $profile_contact;
	
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
		// $data					= $this->initData();
		$data['user']   		= $this->model->newInstance();
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
						'last_name'     => $user->last_name));
	
				/* $data['activationCode']     = $user->GetActivationCode();
				$data['email']              = $inputUser['email'];
				$data['userId']             = $user->getId();
				$data['password']           = $password;
	
				Mail::send('emails.auth.welcome', $data, function($m) use($data)
				{
					$m->to($data['email'])->subject(Config::get('sprim.site_name'));
				}); */		
				
				$this->saveOtherDetails($user, $input);
	
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
		// $data				= $this->initData();
		$data['user']           = $this->user->getById($id, ['club_users']);
		$data['sentry']         = Sentry::findUserById($id);
		$data['user_groups']    = array();
		$data['email_opt']      = 'disabled';
		
		foreach ($data['sentry']->groups as $group){
			$data['user_groups'][] = $group->id;
		}	
		
		// dd($data['user']);
		
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
		$input  = Input::all();
		$model  = $this->model->fields($this->model->find($id), $input);
		$model->updated_by 	= \Session::get('user.id');	
				
		if (!$model->updateUniques()){
			return Redirect::to('wellness-team/'.$id.'/edit')->withErrors($model->errors())->withInput();
		} else {		
			
			$groups		= Sentry::findAllGroups();
			foreach($groups as $group){
				$user->removeGroup($group);
			}
			
			$this->saveOtherDetails($model, $input);		
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
	
		$obj                = $this->model->paginate($pageParams, array(3,4,5));
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
		if ($input['profile_type'] && $input['profile_type'] == '1')
		{
			$group = Sentry::findGroupByName('medical_doctor');
			$user->addGroup($group);
		} else if ($input['profile_type'] && $input['profile_type'] == '2') {
			$group = Sentry::findGroupByName('fitness_coach');
			$user->addGroup($group);
		} else if ($input['profile_type'] && $input['profile_type'] == '3') {
			$group = Sentry::findGroupByName('wellness_expert');
			$user->addGroup($group);
		}
		
		/* $profile_id = $this->profile->_save($user, $input);
		
		$this->profile_contact->_save($input['email'], \Config::get('sprim.contact_types.email'),
				$hcp->profile_id);
		
		$this->profile_contact->_save($input['office_num'], \Config::get('sprim.contact_types.office_num'),
				$hcp->profile_id);
		
		$this->profile_contact->_save($input['mobile_num'], \Config::get('sprim.contact_types.mobile_num'),
				$hcp->profile_id); */
	}
		
}
