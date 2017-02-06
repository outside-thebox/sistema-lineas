<?php namespace App\Api\Transformers;
use JuaGuz\ApiGenerator\BaseTransformer;
class CuentasTransformer extends BaseTransformer
{

    /**
     * @param $item
     * @return array
     */
    public function transform($item)
    {
        return  [
            'id'=>$item['id'],
'nro_cuenta'=>$item['nro_cuenta'],
'nombre_cuenta'=>$item['nombre_cuenta'],
'dominio'=>$item['dominio'],
'nombre_server_principal'=>$item['nombre_server_principal'],
'nombre_server_backup'=>$item['nombre_server_backup'],
'created_at'=>$item['created_at'],
'updated_at'=>$item['updated_at'],

        ];
    }
}