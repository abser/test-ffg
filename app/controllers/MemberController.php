<?php

use Sprim\Repositories\Contracts\AddressInterface as Address;
use Sprim\Repositories\Contracts\UserInterface as User;
use Sprim\Repositories\Contracts\ClubInterface as Club;
use Sprim\Repositories\Contracts\ServiceInterface as Service;

class MemberController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct(User $user, Club $club, Service $service, Address $address) {

        $this->model = $user;
        $this->address = $address;
        $this->service = $service;
        $this->club = $club;
        parent::__construct();
        $this->owner_table = Config::get('sprim.tables.user');
        $this->sort = 'first_name';
        $this->dir = 'asc';

        $this->route_prefix = 'user';
    }

    public function index() {
        $data = $this->getList();
        $data['route'] = 'member.index';
        return View::make("member.index", compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $data['clubs'] = $this->club->getSelectList();
        $data['route'] = 'member';
        $data['header'] = 'Add New Member';
        $data['form'] = 'Member';
        $data['email_disabled'] = '';
        $data['paId'] = $this->model->getPaList();
        $data['service'] = $this->model->getServiceList();
        // $data['rooms'] = $this->model->getServiceList();
        return View::make('member.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $user_id = Sentry::getUser();
        $logged_user_id = $user_id['id'];

        $member_password = $this->ranPass();

        $senData = Sentry::register(array(
                    'email' => $_POST['member_email'],
                    'password' => $member_password,
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
        ));

        $member_id = $this->model->createMember(Input::all(), $senData['id'], $logged_user_id);
        $fileData = explode('+', $member_id);
        $user_id = $fileData[0];
        $address_id = $fileData[1];
        $file = array('image' => Input::file('image'));
        $rules = array('image' => 'required',);

        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            $model = $this->model->createProfile($user_id, $address_id, Input::all());
        } else {
            if (Input::file('image')->isValid()) {
                $destinationPath = 'uploads_pic'; // upload path
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = "member_id_" . $user_id . "_" . rand(11111, 99999) . '.' . $extension; // renameing image
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                echo $destinationPath;
                $model = $this->model->createProfile($user_id, $address_id, Input::all(), $fileName);
            }
        }

        $data['logged_user_id'] = $logged_user_id;
        $data['member_email'] = $_POST['member_email'];
        $data['member_password'] = $member_password;
        \Mail::send('emails.auth.member_mail', $data, function($m) use($data) {
            $m->to($data['member_email'])->subject(\Config::get('sprim.site_name'));
        });
        Session::flash('message', 'Member created successfully');
        return Redirect::route('member.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $data['member'] = $this->model->EditmemberList($id);
        $data['addressData'] = $this->address->getById($data['member'][0]->address_id);
        $data['clubs'] = $this->club->getSelectList();
        $data['paId'] = $this->model->getPaList();
        if (!$data['member']) {
            return Response::view('errors.404', array(), 404);
        }

        return View::make('member.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $model = $this->model->updateMember(Input::all());
        return Redirect::route('member.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

    public function activateAction($id) {
        $model = $this->model->find($id);
        $model->activated = 1;
        $model->updated_by = \Session::get('user.id');
        if (!$model->save()) {
            return Redirect::to('member')->withErrors($model->errors())->withInput();
        } else {
            Session::flash('message', 'Successfully activated the member');
            return Redirect::to('member');
        }
    }

    public function deactivateAction($id) {
        $model = $this->model->find($id);
        $model->activated = 0;
        $model->updated_by = \Session::get('user.id');
        if (!$model->save()) {
            return Redirect::to('member')->withErrors($model->errors())->withInput();
        } else {
            Session::flash('message', 'Successfully de-activated the member');
            return Redirect::to('member');
        }
    }

    public function messageAction($id) {
        $data['route'] = 'member';
        $data['header'] = 'message';
        $data['form'] = 'Member_message';
        $data['member_id'] = $id;
        return View::make('member.message', compact('data'));
    }

    public function messageBroadcast($id = '') {
        $data['route'] = 'member';
        $data['header'] = 'message';
        $data['form'] = 'Member_message';
        $data['member_id'] = $id;
        return View::make('member.message', compact('data'));
    }

    public function sendMessage() {
        $id = $_POST['member_id'];
        $member_data = $this->model->find($id, $id);
        $user_id = Sentry::getUser();
        $data['logged_user_id'] = $user_id['id'];
        $data['member_email'] = $member_data['email'];
        $data['fname'] = $member_data['first_name'];
        $data['member_id'] = $member_data['id'];
        $data['msg_body'] = $_POST['msg_body'];
        \Mail::send('emails.auth.member_message_mail', $data, function($m) use($data) {
            $m->to($data['member_email'])->subject(\Config::get('sprim.site_name'));
        });
        Session::flash('message', 'Message send successfully');
        return Redirect::to('member');
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

    public function servicelist() {
        return $serviceList = $this->model->getServiceList();
    }

    public function memberList() {
        $tbl_user = $this->User->getTable();
        $tbl_profile_contact = $this->ProfileContacts->getTable();
        $memberdata = $this->User->select($tbl_user . '.id', $tbl_user . '.email', $tbl_user . '.first_name', $tbl_user . '.last_name', $tbl_user . '.activated', 'profile_contacts.info')
                ->join('profile_contacts', $tbl_user . '.id', '=', 'profile_contacts.user_id')
                ->where('profile_contacts.contact_type', '=', 3)
                ->whereNotIn($tbl_user . '.id', array(1, 2, 3));
        return $resultData = $memberdata->get();
    }

    protected function getList() {
        $pageParams = Helpers::paginatorParams($this->sort, $this->dir);
        $data = $pageParams;
        $data['r_prefix'] = 'member';
        $data['s_fields'] = array('all' => 'All', 'name' => 'Member Name', 'service_category' => 'Service Category');

        $obj = $this->model->paginateUsers($pageParams, 'memberUser');
        $data['model'] = Paginator::make($obj->items, $obj->totalItems, $pageParams['limit']);

        $data['controller'] = 'member';
        return $data;
    }

}
