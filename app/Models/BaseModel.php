<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    protected $model;

    /**
     * @param array $data
     * @return mixed
     */
    public function create(array $data) {
        return $this->model->create($data);
    }

        /**
     * @param array $data
     * @param $id
     * @param string $attribute
     * @return mixed
     */
    public function update(array $data, $id, $attribute="id") {
        return $this->model->where($attribute, '=', $id)->update($data);
    }
}