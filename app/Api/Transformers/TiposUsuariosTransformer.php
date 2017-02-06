<?php namespace App\Api\Transformers;
use JuaGuz\ApiGenerator\BaseTransformer;
class TiposUsuariosTransformer extends BaseTransformer
{

    /**
     * @param $item
     * @return array
     */
    public function transform($item)
    {
        return  [
            'id'=>$item['id'],
'descripcion'=>$item['descripcion'],
'created_at'=>$item['created_at'],
'updated_at'=>$item['updated_at'],

        ];
    }
}