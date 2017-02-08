<?php

use Illuminate\Database\Seeder;

class SeederUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [
                'nombre' => 'Damián',
                'apellido' => 'Ladiani',
                'username' => 'pollitofive',
                'email' => 'damianladiani@gmail.com',
                'password' => bcrypt("123456"),
                'tipo_usuario_id' => 1,
            ]
        );
    }
}
