<?php
use Illuminate\Database\Seeder;
use App\Accion;
use App\RoleAccion;

class AccionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Superusuario ->id 1
        // Administrador ->id 2
        // Agente Regional ->id 3
        // Gerente ->id 4


        #Los Ids van sucesivos a lo que va creando
        Accion::create([
            'accionName' => 'Registrar Usuarios'
        ]); //1
        Accion::create([
            'accionName' => 'Registrar UU.SS.'
        ]); //2
        Accion::create([
            'accionName' => 'Registrar Tracker'
        ]); //3
        Accion::create([
            'accionName' => 'Registrar Tripulacion'
        ]); //4
        Accion::create([
            'accionName' => 'Registrar Localizacion'
        ]); //5
        Accion::create([
            'accionName' => 'Editar Usuarios'
        ]); //6
        Accion::create([
            'accionName' => 'Editar UU.SS.'
        ]); //7
        Accion::create([
            'accionName' => 'Editar Tracker'
        ]); //8
        Accion::create([
            'accionName' => 'Editar Tripulacion'
        ]); //9
        Accion::create([
            'accionName' => 'Editar Localizacion'
        ]); //10
        Accion::create([
            'accionName' => 'Eliminar Usuarios'
        ]); //11
        Accion::create([
            'accionName' => 'Eliminar UU.SS.'
        ]); //12
        Accion::create([
            'accionName' => 'Eliminar Tracker'
        ]); //13
        Accion::create([
            'accionName' => 'Eliminar Tripulacion'
        ]); //14
        Accion::create([
            'accionName' => 'Eliminar Localizacion'
        ]); //15
        Accion::create([
            'accionName' => 'Listar Usuarios'
        ]); //16
        Accion::create([
            'accionName' => 'Listar UU.SS.'
        ]); //17
        Accion::create([
            'accionName' => 'Listar Tracker'
        ]); //18
        Accion::create([
            'accionName' => 'Listar Tripulacion'
        ]); //19
        Accion::create([
            'accionName' => 'Listar Localizacion'
        ]); //20


        //crear usuarios superuser
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 1, //Registrar Usuarios
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 2, //Registrar UU.SS.
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 3, //Registrar Trackers
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 4, //Registrar Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 5  //Registrar Localizacion
        ]);

        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 6, //Update Usuarios
        ]);

        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 7, //Update UUSS
        ]);

        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 8, //Update Trackers
        ]);

        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 9, //Update Tripulacion
        ]);

        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 10 //Update Localizacion
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 11, //Delete Usuarios
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 13, //Delete Trackers
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 14, //Delete Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 15  //Delete Localizacion
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 16, //Listar Usuarios
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 17, //Listar UUSSn
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 18, //Listar Trackers
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 19, //Listar Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 1,
            'accion_id' => 20  //Listar Localizacion
        ]);
        // ADMINISTRADOR
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 1, //Registrar Usuarios
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 2, //Registrar UUSS
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 3, //Registrar Trackers
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 4  //Registrar Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 6, //Update Usuarios
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 7, //Update UUSS
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 8, //Update Trackers
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 9  //Update Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 11, //Delete Usuarios
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 12, //Delete UUSS
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 13, //Delete Trackersn
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 14  //Delete Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 16, //Listar Usuarios
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 17, //Listar las UU.SS. de todo lado, pero no ver la posicion.
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 18, //Listar Trackers
        ]);
        RoleAccion::create([
            'role_id' => 2,
            'accion_id' => 19  //Listar Tripulacion
        ]);
        //GERENTE
        RoleAccion::create([
            'role_id' => 3,
            'accion_id' => 4  //Registrar Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 3,
            'accion_id' => 9  //Update Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 3,
            'accion_id' => 14  //Delete Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 3,
            'accion_id' => 16, //Listar Usuarios para que el gerente pueda ver, solo ver los usuarios que administran el sistema **
        ]);
        RoleAccion::create([
            'role_id' => 3,
            'accion_id' => 17, //Listar UUSS
        ]);
        RoleAccion::create([
            'role_id' => 3,
            'accion_id' => 18, //Listar Trackers
        ]);
        RoleAccion::create([
            'role_id' => 3,
            'accion_id' => 19  //Listar Tripulacion
        ]);
        // AGENTE
        RoleAccion::create([
            'role_id' => 4,
            'accion_id' => 4  //Registar Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 4,
            'accion_id' => 9  //Update Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 4,
            'accion_id' => 14  //Delete Tripulacion
        ]);
        RoleAccion::create([
            'role_id' => 4,
            'accion_id' => 17, //Listar UUSS, quiza solo listar las UU.SS. que le pertenescan
        ]);
        RoleAccion::create([
            'role_id' => 4,
            'accion_id' => 19  //Listar Tripulacion
        ]);
        // RoleAccion::create([
        //     'role_id' => 2,
        //     'accion_id' => 1
        // ]);
    }
}
