<?php

namespace Sprim\Repositories\Eloquent;

//use Sprim\Model\Services;
use Sprim\Model\Member;
use Sprim\Model\Address;
use Sprim\Model\UserProfile;
use Sprim\Model\ProfileContacts;
use Sprim\Model\PaUsers;
use Sprim\Model\User;
use Sprim\Model\Service;
use Sprim\Model\ClubUser;
use Sprim\Model\ServiceUsers;
use Sprim\Model\UserGroup;
use Sprim\Repositories\Contracts\MemberInterface;

class MemberRepository extends AbstractRepository implements MemberInterface {

    protected $model;

    public function __construct(Member $model, Address $address, UserProfile $UserProfile, ProfileContacts $ProfileContacts, PaUsers $PaUsers, User $User, Service $service, ClubUser $ClubUsers, ServiceUsers $ServiceUser,UserGroup $UserGroup) {
        $this->model = $model;
        $this->address = $address;
        $this->UserProfile = $UserProfile;
        $this->ProfileContacts = $ProfileContacts;
        $this->PaUsers = $PaUsers;
        $this->service = $service;
        $this->User = $User;
        $this->ClubUsers = $ClubUsers;
        $this->ServiceUser = $ServiceUser;
        $this->UserGroup = $UserGroup;
        parent::__construct();
    }



    public function createMember($input, $memberId, $user_id) {
//        echo '<pre>';
//        // print_r($input['member_service']);
//        echo '</pre>';
//
//        foreach ($input['member_service'] as $serviceId) {
//            echo $serviceId;
//        }
//        die();
        $groupUsersId = $this->UserGroup->create(['user_id' => $memberId, 'group_id' => 4]);
        $clubUsersId = $this->ClubUsers->create(['user_id' => $memberId, 'club_id' => $input['club_id'], 'type' => 4, 'status' => 1, 'created_by' => $user_id]);
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

//        if (isset($input['PaId'])) {
//            $PaUsersId = $this->PaUsers->create(['user_id' => $user_id, 'pa_user_id' => $input['PaId']]);
//        }
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

    public function memberList() {
        $tbl_user = $this->User->getTable();
        $tbl_profile_contact = $this->ProfileContacts->getTable();
        $memberdata = $this->User->select($tbl_user . '.id', $tbl_user . '.email', $tbl_user . '.first_name', $tbl_user . '.last_name', $tbl_user . '.activated', 'profile_contacts.info')
                ->join('profile_contacts', $tbl_user . '.id', '=', 'profile_contacts.user_id')
                ->where('profile_contacts.contact_type', '=', 3)
                ->whereNotIn($tbl_user . '.id', array(1, 2, 3));
        return $resultData = $memberdata->get();
    }

    public function acativeMember($memberId) {
        if ($memberId['member_status'] == 'activate') {
            $status = 1;
        } else {
            $status = 0;
        }
        $memberId = $this->User->where('id', $memberId['member_id'])->update(array('activated' => $status));
    }

 

}
