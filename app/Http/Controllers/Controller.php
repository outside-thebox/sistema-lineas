<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Mockery\CountValidator\Exception;

class Controller extends BaseController
{
    use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

    protected function respuesta($manager)
    {
        if(!$manager->isValid())
        {
            return Response()->json([
                'errores' => $manager->getErrors(),
                'success' => false
            ],404);
        }

        try{
            if($manager->save())
            {
                return Response()->json([
                    'errores' => null,
                    'success' => true
                ],200);
            }
            else
            {
                return Response()->json([
                    'errores' => $manager->getErrors(),
                    'success' => false
                ],404);

            }        }
        catch(\Exception $e)
        {
            return $e->getMessage();
        }

    }
}
