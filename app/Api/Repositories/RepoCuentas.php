<?php

/**
 * Created by PhpStorm.
 * User: damian
 * Date: 05/02/17
 * Time: 19:49
 */

namespace App\Api\Repositories;


use App\Api\Entities\Mysql\Cuentas;

class RepoCuentas extends RepoBase
{
    var $data = [];
    public function __construct($data = [])
    {
        $this->data = $data;
    }

    public function getModel()
    {
        return new Cuentas();
    }


}