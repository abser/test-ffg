<?php

namespace Sprim\Repositories\Eloquent;

abstract class AbstractContactRepository extends AbstractRepository
{
	public $allow_null = true;
	
    public static function getCommaList($contacts)
    {
        $email              = $phone_office = $phone_mobile = $fax = array();

        foreach ($contacts as $contact){
            if($contact->type == 3){
                $email[]        = $contact->info;
            } else if($contact->type == 1){
                $phone_office[] = $contact->info;
            } else if($contact->type == 2){
                $phone_mobile[] = $contact->info;
            } else if($contact->type == 4){
                $fax[] = $contact->info;
            }
        }
        $data['email']           = implode(', ', $email);
        $data['phone_office']    = implode(', ', $phone_office);
        $data['phone_mobile']    = implode(', ', $phone_mobile);
        $data['fax']             = implode(', ', $fax);
        
        return $data;

    }
    
    public function getArrayContacts($contacts)
    {
        $email      = array();
        $office_num = array();
        $fax        = array();
        $mobile_num = '';
        
        foreach($contacts as $contact){
            switch ($contact->type){
                case 3:
                    $email[]    = $contact->info;
                    break;
                case 2:
                    $mobile_num[]   = $contact->info;
                    break;
                case 1:
                    $office_num[]   = $contact->info;
                    break;
                case 4:
                    $fax[]          = $contact->info;
                    break;
            }
        }
        
        return compact('email', 'office_num', 'mobile_num', 'fax');
    }
    
    public function _save($info, $type, $id)
    {
        if (empty($info) || empty ($id)){
            return;
        }
        
        $info_arr = (!is_array($info))? array($info) : $info;
        
        $fail = false;
        $info = array_filter(array_map('trim', $info_arr));
        
        if(!$info && !$this->allow_null){
        	return true;
        }
        
        $check_delete    = $this->model->where($this->label.'_id', '=', $id)->where('type', '=', $type)->get();

        foreach ( $check_delete as $contact){
            if(!in_array($contact->info, $info)){
                $this->model->where($this->label.'_id', '=', $id)->where('info', '=', $contact->info)->delete();
            }
        }
        
        foreach ( $info as $contact){
            
            if ($type == 3){
                $validator = \Validator::make(
                    array('name' => $contact),
                    array('name' => array('email'))
                );
                $fail = $validator->fails();
            }
            
            if ($fail){
                return false;
            } 
            
            $label_id           = $this->label.'_id';
            $new                = $this->newInstance();
            $new->info          = $contact;
            $new->type          = $type;
            $new->{$label_id}   = $id;

            $check_exist    = $this->model->where($this->label.'_id', '=', $id)->
                            where('info', '=', $contact)->get();

            if ($check_exist->isEmpty()) {
                $new->save();
            }
        }
        
        return true;
    }
    
    public function swap($keep_id, $delete_id, $type)
    {
        $this->model->where($this->label.'_id', '=', $keep_id)->
                where('type', '=', $type)->delete();

        $this->model->where($this->label.'_id', $delete_id)->where('type', $type)
            ->update(array($this->label.'_id' => $keep_id));
    }
}