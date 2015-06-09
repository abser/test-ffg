<?php

use Sprim\Repositories\Contracts\UserInterface as User;
use Sprim\Repositories\Contracts\MemberInterface as Member;
use Sprim\Repositories\Contracts\ClubInterface as Club;

class UserController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct(User $user, Member $member, Club $club) {

        $this->model = $user;
        $this->member = $member;
        $this->club = $club;
        parent::__construct();
        //$this->owner_table = Config::get('sprim.tables.room');
        $this->sort = 'name';
        $this->dir = 'asc';

        $this->route_prefix = 'user';
    }

    public function index() {
        $data = $this->getList();
//        echo '<pre>';
//        print_r($data);
//        echo '</pre>';
//        die();
        $data['route'] = 'user.index';

        return View::make("user.index", compact('data'));
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
        return View::make('user.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        $user_id = Sentry::getUser();
        $logged_user_id = $user_id['id'];

        $member_password = $this->model->ranPass();

        $senData = Sentry::register(array(
                    'email' => $_POST['member_email'],
                    'password' => $member_password,
                    'first_name' => $_POST['first_name'],
                    'last_name' => $_POST['last_name'],
        ));

        $member_id = $this->model->createUser(Input::all(), $senData['id'], $logged_user_id);

        $data['logged_user_id'] = $logged_user_id;
        $data['member_email'] = $_POST['member_email'];
        $data['member_password'] = $member_password;
        \Mail::send('emails.auth.member_mail', $data, function($m) use($data) {
            $m->to($data['member_email'])->subject(\Config::get('sprim.site_name'));
        });
        Session::flash('message', 'user created successfully');
        return Redirect::route('user.index');





        // die();
//        Sentry::createGroup(array(
//            'name' => 'pa',
//            'permissions' => array(
//                'pa_appt_full_access' => 1,
//                'pa_view_alpa_cancel_appointment' => 1,
//                'pa_calender_appointment' => 0,
//                'pa_create_appointment' => 1,
//                'pa_cancel_appointment' => 0,
//                'pa_group_full_access' => 1,
//                'pa_view_all_group' => 1,
//            ),
//        ));



        $input = Input::only('_token', 'permissions');

        if (!$group = Sentry::createGroup($input)) {
            // return Redirect::to('roles/create')->withErrors($group->errors())->withInput();
        } else {
            // return Redirect::to('roles');
        }
        die();
        Sentry::createGroup(array(
            'name' => 'Subscribers',
            'permissions' => array(
                'admin' => 1,
                'users' => 1,
            ),
        ));
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
        $data['user'] = $this->model->EditUserList($id);
        $data['clubs'] = $this->club->getSelectList();
        $data['user_id_edit'] = $id;
        if (!$data['user']) {
            return Response::view('errors.404', array(), 404);
        }

        return View::make('user.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        try {
            // Find the user using the user id
            $user = Sentry::findUserById($id);

            $user_id = Sentry::getUser();
            $logged_user_id = $user_id['id'];
            // Update the user details
            $user->email = Input::get("member_email");
            $user->first_name = Input::get("first_name");
            $user->last_name = Input::get("last_name");
            // Update the user
            if ($user->save()) {
                $data['logged_user_id'] = $logged_user_id;
                $data['member_email'] = Input::get("member_email");
                \Mail::send('emails.auth.member_update_mail', $data, function($m) use($data) {
                    $m->to($data['member_email'])->subject(\Config::get('sprim.site_name'));
                });
            } else {
                // User information was not updated
            }
        } catch (Cartalyst\Sentry\Users\UserExistsException $e) {
            echo 'User with this login already exists.';
        } catch (Cartalyst\Sentry\Users\UserNotFoundException $e) {
            echo 'User was not found.';
        }
        $model = $this->model->updateUser(Input::all());
        return Redirect::route('user.index');
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

    protected function getList() {
        $pageParams = Helpers::paginatorParams($this->sort, $this->dir);
        $data = $pageParams;
        $data['r_prefix'] = 'user';
        $data['s_fields'] = array('all' => 'All', 'name' => 'user Name', 'service_category' => 'Service Category');

        $obj = $this->model->paginate($pageParams);
        $data['model'] = Paginator::make($obj->items, $obj->totalItems, $pageParams['limit']);

        $data['controller'] = 'user';
        return $data;
    }

    public function activateAction($id, $stat) {
        $model = $this->member->find($id);
        $model->activated = 1;
        $model->updated_by = \Session::get('user.id');
        $model->save();
        if (!$model->save()) {
            return Redirect::to('user')->withErrors($model->errors())->withInput();
        } else {
            Session::flash('message', 'Successfully activated the user');
            if ($stat == "member") {
                return Redirect::to('member');
            } else {
                return Redirect::to('user');
            }
        }
    }

    public function deactivateAction($id, $stat) {
        $model = $this->member->find($id);
        $model->activated = 0;
        $model->updated_by = \Session::get('user.id');
        if (!$model->save()) {
            return Redirect::to('user')->withErrors($model->errors())->withInput();
        } else {
            Session::flash('message', 'Successfully de-activated the user');
            if ($stat == "member") {
                return Redirect::to('member');
            } else {
                return Redirect::to('user');
            }
        }
    }

}
