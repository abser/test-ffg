<?php

namespace Sprim\Repositories\Eloquent;

abstract class AbstractRepository
{

    public function __construct()
    {
        
    }
    
    public function create($data)
    {
        return $this->model->create($data);
    }


    public function newInstance()
    {
        return new $this->model;
    }
    
    public function all()
    {
        return $this->model->all();
    }
    
    public function save()
    {
        return $this->model->save();
    }
    
    public function delete()
    {
        return $this->model->delete();
    }
    
    public function destroy($id)
    {
        return $this->model->destroy($id);
    }
    
    public function errors()
    {
        return $this->model->errors();
    }

    public function find($id)
    {
        return $this->model->find($id);
    }

    public function make(array $with = array())
    {
        return $this->model->with($with);
    }

    public function getById($id, array $with = array())
    {
        $query = $this->make($with);

        return $query->find($id);
    }

    public function getFirstBy($key, $value, array $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->first();
    }

    public function getManyBy($key, $value, array $with = array())
    {
        return $this->make($with)->where($key, '=', $value)->get();
    }

    public function getFirstOrCreate($data)
    {
        return $this->model->firstOrCreate($data);
    }
    
    protected function keepOldData($model)
    {
        foreach($model->getDirty() as $attribute => $value){
            if(!$value){
                $original= $model->getOriginal($attribute);
                $model->setAttribute($attribute, $original);
            }
        }
        
        return $model;
    }

    protected function clientRoleId()
    {
        $group = \Sentry::findGroupByName('client');
        
        return $group->id;
    }
}