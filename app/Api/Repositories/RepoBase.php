<?php

/**
 * Created by PhpStorm.
 * User: damian
 * Date: 05/02/17
 * Time: 19:50
 */

namespace App\Api\Repositories;

use JuaGuz\ApiGenerator\Clases\Model;

abstract class RepoBase
{
    protected $model;

    protected function __construct(Model $model)
    {
        $this->model = $model;
    }

    abstract public function getModel();

    public function find($id)
    {
        return $this->getModel()->find($id);
    }
}