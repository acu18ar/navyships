<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name' => 'Superusuario'
        ]);
        Role::create([
            'name' => 'Administrador'
        ]);
        Role::create([
            'name' => 'Agente Regional'
        ]);
        Role::create([
            'name' => 'Gerente'
        ]);


        User::create([
            'username' => 'root',
            'email' => 'root@naval.com',
            'password' => bcrypt('root1234'),
            'grado' => 'Almirante',
            'first_name' => 'Pepito',
            'last_name' => 'Perez',
            'role_id' => 1,
            'localidad_id' => null
        ]);
    }
}
