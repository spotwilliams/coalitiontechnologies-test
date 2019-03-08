<?php


namespace App\Repositories;


use App\Models\Model;

abstract class Repository
{

    public abstract function store(Model $model);

    public abstract function update(Model $model, $id);

    public abstract function delete($id);

    public abstract function find($id);

    public abstract function lastId();
}