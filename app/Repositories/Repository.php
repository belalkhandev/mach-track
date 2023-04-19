<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

abstract class Repository
{
    abstract public function model();

    public function query()
    {
        return $this->model()::query();
    }

    public function getAll()
    {
        return $this->model()::all();
    }

    public function getByPaginate()
    {
        return $this->model()->paginate();
    }

    public function first()
    {
        return $this->model()::first();
    }

    public function find($primaryKey)
    {
        return $this->model()::find($primaryKey);
    }

    public function findOrFail($primaryKey)
    {
        return $this->model()::findOrFail($primaryKey);
    }

    public function delete($primaryKey)
    {
        return $this->model()::destroy($primaryKey);
    }

    public function create(array $data)
    {
        return $this->model()::create($data);
    }

    public function update(Model $model, array $data)
    {
        return $model->update($data);
    }
}
