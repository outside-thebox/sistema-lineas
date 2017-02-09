<?php
/**
 * Created by PhpStorm.
 * User: damian
 * Date: 05/02/17
 * Time: 19:57
 */

namespace App\Api\Manager;

class ManagerCuentas extends ManagerBase
{
    public function getRules()
    {
        return [
            'nro_cuenta' => 'required',
            'nombre_cuenta' => 'required',
            'dominio' => 'required | url',
            'nombre_server_principal' => 'required',
            'nombre_server_backup' => 'required'
        ];
    }

    public function getMessages()
    {
        return [

        ];
    }
}
