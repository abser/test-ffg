<?php

namespace Sprim\Repositories\Eloquent;

abstract class AbstractRepository {

    protected $country_list = null;
    protected $mysql_dt_format = null;
    protected $tbl_country = 'addresses';

    public function __construct() {
        if (!\Session::get('user.is_admin')) {
            $countries = ['""'];

            if (\Session::get('user.countries')) {
                $countries = [];
                foreach (\Session::get('user.countries') as $val) {
                    $countries[] = '"' . $val . '"';
                }
            }

            $this->country_list = implode(', ', $countries);
        }

        $this->mysql_dt_format = \Config::get('sprim.date_format.mysql');
        $this->file_type = \Config::get('sprim.file_types');
        $this->contact_type = \Config::get('sprim.contact_types');
    }

    public function create($data) {
        return $this->model->create($data);
    }

    public function newInstance() {
        return new $this->model;
    }

    public function all() {
        return $this->model->all();
    }

    public function save() {
        return $this->model->save();
    }

    public function delete() {
        return $this->model->delete();
    }

    public function destroy($id) {
        return $this->model->destroy($id);
    }

    public function errors() {
        return $this->model->errors();
    }

    public function find($id) {
        return $this->model->find($id);
    }

    public function make(array $with = array()) {
        return $this->model->with($with);
    }

    public function getById($id, array $with = array()) {
        $query = $this->make($with);

        return $query->find($id);
    }

    public function getFirstBy($key, $value, array $with = array()) {
        return $this->make($with)->where($key, '=', $value)->first();
    }

    public function getManyBy($key, $value, array $with = array()) {
        return $this->make($with)->where($key, '=', $value)->get();
    }

    public function getFirstOrCreate($data) {
        return $this->model->firstOrCreate($data);
    }

    public function paginate($arr, $controllertype = '') {
        extract($arr);
        $result = new \StdClass;
        $result->page = $page;
        $result->limit = $limit;
        $result->totalItems = 0;
        $result->items = array();

        $query = $this->filteredModel(trim($s_term), $s_field);
        $order = $this->sqlField($sort);

        $result->totalItems = count($query->get());
        $result->items = $query->skip($limit * ($page - 1))->take($limit)->orderBy($order, $dir)->get();

        return $result;
    }

    public function simlplePaginate($limit, $filter = null) {
        if (is_array($filter)) {
            return $this->model->where($filter['field'], $filter['operator'], $filter['value'])->paginate($limit);
        }

        return $this->model->paginate($limit);
    }

    public function sqlField($field) {
        return (array_key_exists($field, $this->fields) ? $this->fields[$field] : $field);
    }

    protected function keepOldData($model) {
        foreach ($model->getDirty() as $attribute => $value) {
            if (!$value) {
                $original = $model->getOriginal($attribute);
                $model->setAttribute($attribute, $original);
            }
        }

        return $model;
    }

    protected function clientRoleId() {
        $group = \Sentry::findGroupByName('client');

        return $group->id;
    }

}
