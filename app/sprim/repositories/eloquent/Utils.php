<?php
namespace Sprim\Repositories\Eloquent;
# Class with methods that executes a task

Class Utils
{
    public static function tbl_columns()
    {
        return  \App::make('Sprim\Repositories\Contracts\TblColumnsInterface');
    }
    
    public static function address()
    {
        return  \App::make('Sprim\Repositories\Contracts\AddressInterface');
    }
    
    public static function profile()
    {
        return  \App::make('Sprim\Repositories\Contracts\ProfileInterface');
    }
    
    public static function user()
    {
        return  \App::make('Sprim\Repositories\Contracts\UserInterface');
    }
    
    public static function userGroup()
    {
        return  \App::make('Sprim\Repositories\Contracts\UserGroupInterface');
    }

        public static function getColumns ($table)
    {
        $tbl_columns = self::tbl_columns();
        
        return $tbl_columns->getListForTable($table);
    }
    
    public static function setColumns ($columns, $table)
    {
        $tbl_columns = self::tbl_columns();
        
        return $tbl_columns->setColumns($columns, $table);
    }
    
    public static function addressSave ($input, $_address_id = null, $allow_null = true)
    {
        $address = self::address();
        
        return $address->_save($input, $_address_id);
    }
    
    public static function profileSave ($relatedModel, $input)
    {
        $profile = self::profile();
        
        return $profile->_save($relatedModel, $input);
    }
    
    public static function getSuperAdminbyClient($id)
    {
        $userGroup = self::userGroup();
        
        return $userGroup->getSuperAdminbyClient($id);
    }

}
