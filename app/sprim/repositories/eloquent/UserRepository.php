<?php

namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\UserInterface;
use Sprim\Model\User;
use Sprim\Model\Address;
use Sprim\Model\Club;
use Sprim\Model\UserProfile;
use Sprim\Model\ProfileContacts;
use Sprim\Model\PaUsers;
use Sprim\Model\Service;
use Sprim\Model\ClubUser;
use Sprim\Model\ServiceUsers;
use Sprim\Model\UserGroup;
use Carbon\Carbon;

class UserRepository extends AbstractRepository implements UserInterface {

    protected $model;

    public function __construct(User $model, Address $address, UserProfile $UserProfile, ProfileContacts $ProfileContacts, PaUsers $PaUsers, Service $service, ClubUser $ClubUsers, ServiceUsers $ServiceUser, UserGroup $UserGroup, Club $Club) {
        $this->model = $model;
        $this->address = $address;
        $this->UserProfile = $UserProfile;
        $this->ProfileContacts = $ProfileContacts;
        $this->PaUsers = $PaUsers;
        $this->service = $service;
        $this->ClubUsers = $ClubUsers;
        $this->Club = $Club;
        $this->ServiceUser = $ServiceUser;
        $this->UserGroup = $UserGroup;
        parent::__construct();
    }

    protected $fields = [
        'first_name' => 'users.first_name',
        'last_name' => 'users.last_name'
    ];

    public function fields($model, $input) {
        $model->email = \Helpers::keyInput('email', $input);
        $model->password = \Helpers::keyInput('password', $input);
        $model->first_name = \Helpers::keyInput('first_name', $input);
        $model->last_name = \Helpers::keyInput('last_name', $input);
        $model->password_confirmation = \Helpers::keyInput('password', $input);

        if (array_key_exists('title', $input)) {
            $model->title = \Helpers::keyInput('title', $input);
        }

        if (array_key_exists('password_confirmation', $input)) {
            $model->password_confirmation = \Helpers::keyInput('password_confirmation', $input);
        }

        return $model;
    }

    public function paginate($arr, $groups = null)
    {
    	extract($arr);
    	$result                     = new \StdClass;
    	$result->page               = $page;
    	$result->limit              = $limit;
    	$result->totalItems         = 0;
    	$result->items              = array();
    
    	$query = $this->filteredModel(trim($s_term), $s_field, $groups);
    	$order = $this->sqlField($sort);
    
    	$result->totalItems         = count($query->get());
    	$result->items              = $query->skip($limit * ($page - 1))->take($limit)->orderBy($order, $dir)->get();
    
    	return $result;
    }
    
    public function filteredModel($s_term = null, $s_field = 'all', $groups = null)
    {        
        $model = \DB::table('users')
        	->select(\DB::raw('users.id, users.first_name, users.last_name, users.email, 
        		profiles.title,
        		sprim_dhs.countries.name AS country
        	'))
        	->leftJoin('profiles', 'users.id', '=', 'profiles.user_id')
        	->leftJoin('addresses', 'profiles.address_id', '=', 'addresses.id')
        	->leftJoin('sprim_dhs.countries', 'sprim_dhs.countries.code', '=', 'addresses.country_code')
        	->leftJoin('users_groups', 'users.id', '=', 'users_groups.user_id');
        $model->whereRaw('users_groups.group_id = 3');
        if ($groups) {
            // $model->whereRaw('(users_groups.group_id IN (' . $groups . '))');
            $model->whereIn('users_groups.group_id', $groups);           
        }
        return $model;
    }

    private function validate($input) {
        $password = strval(rand(11111111, 99999999));
        $user = $this->newInstance();
        $user->email = $input['email'];
        $user->password = $password;
        $user->password_confirmation = $password;
        $user->first_name = $input['first_name'];
        $user->last_name = $input['last_name'];

        if (!$user->validate()) {
            return false;
        }
        return $user;
    }

    public function createClientAdmin($client_id, $input) {
        $input['profile']['client_id'] = $client_id;
        $input['permissions'] = [$this->clientRoleId() => '1'];

        return $this->create($input);
    }

    public function create($input) {
        $clnInput = $this->validate($input);
        $is_saved = false;
        if (!$clnInput) {
            return false;
        }

        try {

            $user = \Sentry::register(['email' => $clnInput->email,
                        'password' => $clnInput->password,
                        'first_name' => $clnInput->first_name,
                        'last_name' => $clnInput->last_name]);

            $this->addGroup($user, $input['permissions']);
            //$this->saveProfile($user, $input);

            \Session::flash('success', 'New user has been created');
            $is_saved = true;

            //$this->sendWelcomeEmail($user);
        } catch (Cartalyst\Sentry\Users\LoginRequiredException $e) {
            \Session::flash('error', 'Login field required.');
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            \Session::flash('error', 'User already exists.');
        }

        return $is_saved;
    }

    public function getRandomPassword() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    private function sendWelcomeEmail($user) {
        $data['activationCode'] = $user->GetActivationCode();
        $data['email'] = $user->email;
        $data['userId'] = $user->getId();
        $data['password'] = $user->password;

        \Mail::send('emails.auth.welcome', $data, function($m) use($data) {
            $m->to($data['email'])->subject(\Config::get('sprim.site_name'));
        });
    }

    private function addGroup($user, $permissions) {
        $allGroups = \Sentry::getGroupProvider()->findAll();
        $permissions = \Utils::filterArray($permissions);

        foreach ($allGroups as $group) {

            if (isset($permissions[$group->id])) {
                $user->addGroup($group);
            }
        }
    }

    private function saveProfile($user, $input) {

        $input['profile']['user_id'] = $user->id;

        //use user model instead of sentry
        $user_model = $this->model->find($user->id);

        if (count($user_model->profile)) {
            $user_model->profile_id = $user_model->profile->id;
        }

        return Utils::profileSave($user_model, $input['profile']);
    }

    public function acativeMember($memberId) {
        if ($memberId['member_status'] == 'activate') {
            $status = 1;
        } else {
            $status = 0;
        }
        $memberId = $this->model->where('id', $memberId['member_id'])->update(array('activated' => $status));
    }

    public function getPaList() {
        return $usersId = User::lists('email', 'id');

        $query = \DB::table('users')
                ->select(\DB::raw('users.id, users.email, users_groups.group_id'))
                ->join('users_groups', 'users.id', '=', 'users_groups.user_id')
                ->where('users_groups.group_id', 7);

        return $query->get();
    }

    public function getServiceList($except = null) {
        $init = array();

        $obj = ($except) ? $this->service->where('id', '!=', $except)->orderBy('name')->lists('name', 'id') : $this->service->orderBy('name')->lists('name', 'id');

        $options = array_map(function($name) {
            return ucwords($name);
        }, $obj);

        return array_replace($init, $options);
    }

    public function createMember($input, $memberId, $user_id) {
        $groupUsersId = $this->UserGroup->create(['user_id' => $memberId, 'group_id' => 6]);
         $clubUsersId = $this->ClubUsers->create(['user_id' => $memberId, 'club_id' => $input['club_id'], 'type' => 4, 'status' => 1, 'created_by' => $user_id]);
       // $clubUsersId = $this->ClubUsers->create(['user_id' => $memberId, 'club_id' => $input['club_id'], 'type' => 4, 'status' => 1, 'created_by' => $user_id]);
        if ($memberId != 0) {
            $addressId = $this->address->create(['address1' => $input['address1'], 'address2' => $input['address2'], 'city' => $input['address']['city'], 'region_id' => $input['address']['region_id'], 'country_code' => $input['address']['country_code'], 'postal_code' => $input['postalCode']]);
            $address_id = $addressId['id'];
        }
        return $memberId . "+" . $address_id;
    }

    public function createProfile($user_id, $address_id = '', $input, $pic = '') {
        if (isset($input['display_pic'])) {
            $display_pic = 1;
        } else {
            $display_pic = 0;
        }
        if (isset($input['change_def_pass'])) {
            $change_def_pass = 1;
        } else {
            $change_def_pass = 0;
        }
        if ($input['gender'] == 'M') {
            $gender = "Male";
        } else {
            $gender = "Female";
        }

        if (isset($input['PaId']) && !empty($input['PaId'])) {
            $PaUsersId = $this->PaUsers->create(['user_id' => $user_id, 'pa_user_id' => $input['PaId']]);
        }
        $profileId = $this->UserProfile->create(['user_id' => $user_id, 'address_id' => $address_id, 'profile_image' => $pic, 'display_profile_pic' => $display_pic, 'change_default_password' => $change_def_pass, 'gender' => $gender, 'occupation' => $input['occupation'], 'age_group' => $input['age_group']]);
        $profileId = $profileId['id'];
        if (isset($input['member_email'])) {
            $memberId = $this->ProfileContacts->create(['user_id' => $user_id, 'contact_type' => 1, 'info' => $input['member_email']]);
        }if (isset($input['member_phone'])) {
            $memberId = $this->ProfileContacts->create(['user_id' => $user_id, 'contact_type' => 2, 'info' => $input['member_phone']]);
        }if (isset($input['member_mobile'])) {
            $memberId = $this->ProfileContacts->create(['user_id' => $user_id, 'contact_type' => 3, 'info' => $input['member_mobile']]);
        }
    }

    public function ranPass() {
        $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
        $pass = array(); //remember to declare $pass as an array
        $alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass); //turn the array into a string
    }

    public function createUser($input, $memberId, $user_id) {

        $groupUsersId = $this->UserGroup->create(['user_id' => $memberId, 'group_id' => $input['user_type']]);
        $clubUsersId = $this->ClubUsers->create(['user_id' => $memberId, 'club_id' => $input['club_id'], 'type' => $input['user_type'], 'status' => 1, 'created_by' => $user_id]);
        if (isset($input['member_phone'])) {
            $memberId = $this->ProfileContacts->create(['user_id' => $memberId, 'contact_type' => 2, 'info' => $input['member_phone']]);
        }
        return $memberId;
    }

    public function EditmemberList($id) {
        $query = \DB::table('users')
                ->select(\DB::raw('users.id, users.email, users.first_name,users.last_name, users.activated,users.activated,profile_contacts.info,
                    user_profile.gender,user_profile.age_group,user_profile.occupation,user_profile.interest_hobbies,user_profile.display_profile_pic,user_profile.display_profile_pic,user_profile.change_default_password
    		'))
                ->join('user_profile', 'users.id', '=', 'user_profile.user_id')
                ->join('profile_contacts', 'users.id', '=', 'profile_contacts.user_id')
                // ->join('club_users', 'users.id', '=', 'club_users.user_id')
                // ->whereIn('users.id', array(1, 2, 3))
                ->where('users.id', $id);

        return $query->get();
    }

    public function updateMember($input) {
        $EditUsers = $this->model->where('id', $input['edit_user_id'])->update(array('email' => $input['member_email'], 'email' => $input['member_email'], 'first_name' => $input['first_name'], 'last_name' => $input['last_name']));
        // $EditClubUsers = $this->ClubUsers->where('user_id', $input['edit_user_id'])->update(array('club_id' => $input['club_id']));

        if (isset($input['member_email'])) {
            $EditProfileUsers = $this->ProfileContacts->where('user_id', $input['edit_user_id'])->where('info', 1)->update(array('info' => $input['member_email']));
        }if (isset($input['member_phone'])) {
            $EditProfileUsers = $this->ProfileContacts->where('user_id', $input['edit_user_id'])->where('info', 2)->update(array('info' => $input['member_phone']));
        }if (isset($input['member_mobile'])) {
            $EditProfileUsers = $this->ProfileContacts->where('user_id', $input['edit_user_id'])->where('info', 3)->update(array('info' => $input['member_mobile']));
        }


        if (isset($input['display_pic'])) {
            $display_pic = 1;
        } else {
            $display_pic = 0;
        }

        if (isset($input['change_def_pass'])) {
            $change_def_pass = 1;
        } else {
            $change_def_pass = 0;
        }

        if ($input['gender'] == 'M') {
            $gender = "Male";
        } else {
            $gender = "Female";
        }

        if (isset($input['PaId']) && !empty($input['PaId'])) {
            $EditPaUsers = $this->PaUsers->where('user_id', $input['edit_user_id'])->update(array('pa_user_id' => $input['PaId']));
        }
        $EditUsers = $this->UserProfile->where('user_id', $input['edit_user_id'])->update(array('display_profile_pic' => $display_pic, 'change_default_password' => $change_def_pass, 'gender' => $gender, 'occupation' => $input['occupation'], 'age_group' => $input['age_group']));
    }

    public function EditUserList($id) {
        $query = \DB::table('users')
                ->select(\DB::raw('users.id, users.email, users.first_name,users.last_name, users.activated,users.activated,profile_contacts.info,club_users.club_id'))
                ->join('profile_contacts', 'users.id', '=', 'profile_contacts.user_id')
                 ->join('club_users', 'users.id', '=', 'club_users.user_id')
                // ->whereIn('users.id', array(1, 2, 3))
                ->where('users.id', $id);

        return $query->get();
    }

    public function updateUser($input) {
        if (isset($input['member_phone'])) {
            $EditProfileUsers = $this->ProfileContacts->where('user_id', $input['edit_user_id'])->where('info', 2)->update(array('info' => $input['member_phone']));
        }
    }

    public function getSelectList() {
          $init = array();
        $obj = $this->Club->where('status', '=', '1')->orderBy('name')->lists('name', 'id');
        $options = array_map(function($name) {
            return ucwords($name);
        }, $obj);
        return array_replace($init, $options);
    }

    public function paginateUsers($arr, $pageType = '') {
        extract($arr);
        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();
        $query = $this->filteredUserModel($pageType);
        $order = $this->sqlFieldUser($sort);

        $result->totalItems = count($query->get());
        $result->items = $query->skip($limit * ($page - 1))->take($limit)->orderBy($order, $dir)->get();

        return $result;
    }
       public function sqlFieldUser($field) {
        return (array_key_exists($field, $this->fields) ? $this->fields[$field] : $field);
    }

    public function filteredUserModel($pageType) {
        if ($pageType == 'memberUser') {
            $groupId = 6;
            $query = \DB::table('users')
                    ->select(\DB::raw('users.email, users.first_name, users.id,users.activated,profile_contacts.info,users_groups.group_id,users_groups.user_id,users_groups.group_id '))
                    ->join('users_groups', 'users.id', '=', 'users_groups.user_id')
                    ->join('profile_contacts', 'users.id', '=', 'profile_contacts.user_id')
                    ->where('users_groups.group_id', $groupId)
                    ->where('profile_contacts.contact_type', 3);
        } elseif ($pageType == 'adminUser') {
            $groupId = 2;
            $query = \DB::table('users')
                    ->select(\DB::raw('users.email, users.first_name, users.id,users.activated,profile_contacts.info,users_groups.group_id,users_groups.user_id,users_groups.group_id '))
                    ->join('users_groups', 'users.id', '=', 'users_groups.user_id')
                    ->join('profile_contacts', 'users.id', '=', 'profile_contacts.user_id')
                    ->whereIn('users_groups.group_id', array(2, 7));
        }
        return $query;
    }

}
