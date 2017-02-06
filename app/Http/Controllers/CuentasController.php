<?php

namespace App\Http\Controllers;

use App\Api\Entities\Mysql\Cuentas;
use App\Api\Manager\ManagerCuentas;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class CuentasController extends Controller
{
    public function __construct()
    {
    }

    public function index()
    {
		return view('cuentas.index');
    }

    public function create()
    {
    	return view('cuentas.formulario');
    }

    public function store()
    {
        $data = json_decode(Input::get('cuenta'),true);
        $manager = $this->obtenerManager($data);
        return $this->respuesta($manager);
    }

    private function obtenerManager($data)
    {
        $manager = new ManagerCuentas(new Cuentas,$data);
        return $manager;
    }

}
