<?php

namespace App\Http\Controllers;

use App\Api\Entities\Mysql\Cuentas;
use App\Api\Manager\ManagerCuentas;
use App\Api\Repositories\RepoCuentas;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Input;

class CuentasController extends Controller
{
    private $repoCuentas;

    public function __construct(RepoCuentas $repoCuentas)
    {
        $this->repoCuentas = $repoCuentas;
    }

    public function index()
    {
		return view('cuentas.index');
    }

    public function create()
    {
        $titulo = "Agregar";
    	return view('cuentas.formulario',compact('titulo'));
    }

    public function edit($id)
    {
        $cuenta = $this->repoCuentas->find($id);
        $titulo = "Editar";
        return view('cuentas.formulario',compact('cuenta','titulo'));
    }

    public function store()
    {
        $data = json_decode(Input::get('cuenta'),true);
        $manager = $this->obtenerManager($data);
        return $this->respuesta($manager);
    }

    private function obtenerManager($data)
    {
        $manager = new ManagerCuentas($this->repoCuentas->getModel()->firstOrNew(['id' => $data['id']]),$data);
        return $manager;
    }

}
