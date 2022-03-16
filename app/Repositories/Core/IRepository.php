<?php

namespace App\Repositories\Core;

interface IRepository {
    public function getFieldsSearchable();
    public function model();
    public function makeModel();
    public function paginate($perPage, $columns = ['*']);
    public function allQuery($search = [], $skip = null, $limit = null);
    public function all($search = [], $skip = null, $limit = null, $columns = ['*']);
    public function create($input);
    public function commit($query);
    public function find($id, $columns = ['*']);
    public function findBy($field, $value, $columns = ['*']);
    public function with($relathionship);
}