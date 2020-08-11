<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Role;
use App\Localidad;
use App\LocationUser;

class UserController extends Controller
{
    public function doLogin(Request $request) {
        $credentials = $request->only('username', 'password');
        $user=User::all()->first();
        //dd($user->password,bcrypt('admin1234'));
        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $role=Auth::user()->role->name;
            if ($role=="Superusuario") {
                return redirect()->route('users.index');
            } else if($role=="Administrador") {
                return redirect()->route('users.index');
            } else if ($role=="Agente Regional" || $role=="Gerente") {
                return redirect()->route('buques.index');
            }
        }
        return view('login',['error'=>'Datos Incorrectos']);
    }
    //
    public function index() {
        $users=User::all();
        //return view('user',compact('user'));
        return view('users.index',compact('users'));
    }

    public function create() {
        $roles=Role::all();
        return view('users.create',compact('roles'));
    }

    public function createRegional(User $user) {
        $localidades=Localidad::all();
        return view('users.createRegional',compact('user','localidades'));
    }

    public function store(Request $request) {
        $data=$request->all();
        $user=User::where('email',$data['email'])->first();
        if($user!=null) {
            return redirect()->back()->withErrors(['email']);
        }
        $user=User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'grado' => $data['grado'],
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'role_id' => $data['role_id'],
        ]);
        if ($data['role_id']=="3") {
            return redirect()->route('user.create.regional',$user);
        }
        return redirect()->route('users.index');
    }

    public function localidadUserStore(Request $request) {
        $data=$request->all();
        foreach($data['localidades'] as $localidad) {
            LocationUser::create([
                'user_id' => $data['user_id'],
                'location_id' => $localidad
            ]);
        }
        return redirect()->route('users.index');
    }

    public function edit(User $user) {
        $roles=Role::all();
        return view('users.edit',compact('user','roles'));
    }

    public function update(Request $request, User $user) {
        $data=$request->all();
        $user->update($data);
        return redirect()->route('users.index');
    }

    public function destroy(User $user) {
        $user->delete();
        return redirect()->route('users.index');
    }
}
