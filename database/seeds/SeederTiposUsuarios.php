<?php

use Illuminate\Database\Seeder;

class SeederTiposUsuarios extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipos_usuarios')->insert(
            ['descripcion' => 'Administrador de aplicación']
        );
        DB::table('tipos_usuarios')->insert(
            ['descripcion' => 'Administrador de cuentas']
        );
        DB::table('tipos_usuarios')->insert(
            ['descripcion' => 'Usuario de cuentas']
        );
    }
}
