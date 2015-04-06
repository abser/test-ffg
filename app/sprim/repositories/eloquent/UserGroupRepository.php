<?php

namespace Sprim\Repositories\Eloquent;

use Sprim\Repositories\Contracts\UserGroupInterface;
use Sprim\Repositories\Eloquent\AbstractRepository;
use Sprim\Model\UserGroup;

class UserGroupRepository extends AbstractRepository implements UserGroupInterface
{

    protected $model;

    public function __construct(UserGroup $model)
    {
        $this->model = $model;
    }

    
    public function getSuperAdminbyClient($id)
    {
        return $this->model
            ->join('users', 'users_groups.user_id', '=', 'users.id')
            ->join('profiles', function($join) use($id){
                $join->on('profiles.user_id', '=', 'users.id')
                    ->where('client_id', '=', $id);
            })->where('users_groups.group_id', '=', $this->clientRoleId())->first();
        
    }
}