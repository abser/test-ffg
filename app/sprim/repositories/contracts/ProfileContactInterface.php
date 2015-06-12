<?php namespace Sprim\Repositories\Contracts;

interface ProfileContactInterface {

     public function paginate($arr);
     
     public function getArrayContacts($profile_id);
}