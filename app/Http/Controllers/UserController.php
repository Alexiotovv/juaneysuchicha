<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use DB;
class UserController extends Controller
{

    public function index(Request $request)
    {
        $obj=User::all();
        return view('usuarios.usuario_index',['obj'=>$obj]);   
    }
    
    public function edit($id)
    {
        $obj=User::find($id);
        return view('usuarios.usuario_edit',['obj'=>$obj]);
    }
    public function update(Request $request)
    {
        $id=request('id');
        $obj=User::findOrFail($id);
        $obj->name=request('name');
        $obj->email=request('email');
        $obj->tipo=request('tipo');
        $obj->nombres=request('nombres');
        $obj->apellidos=request('apellidos');
        $obj->nro_stand=request('nro_stand');
        $obj->procedencia=request('procedencia');
        $obj->linea_artesanal=request('linea_artesanal');

        $obj->save();
        // return redirect()->route('usuarios.edit',[$id])->with('guardo','si');
        return redirect()->route('usuarios.index')->with('guardo','si');
    }
    public function create(Request $request)
    {
        return view('usuarios.usuario_create');
    }
    public function store(Request $request)
    {
        $obj=new User();
        $obj->name=request('name');
        $obj->email=request('email');
        $obj->tipo=request('tipo');
        $obj->nombres=request('nombres');
        $obj->apellidos=request('apellidos');
        $obj->nro_stand=request('nro_stand');
        $obj->procedencia=request('procedencia');
        $obj->linea_artesanal=request('linea_artesanal');
        $obj->password = bcrypt($request->input('password'));
        $obj->save();
        return redirect()->route('usuarios.index')->with('guardo','si');
    }


    public function verificanombre($name)
    {
        
        $lista=DB::table('users')
        ->select('users.*')
        ->where('users.name','=',$name)
        ->count();
        if ($lista>0) {
            $data=['estado'=>'No_disponible'];
        }else{
            $data=['estado'=>'Disponible'];
        }
        return response()->json($data);
      }

      public function verificaemail($email)
      {
          
          $lista=DB::table('users')
          ->select('users.*')
          ->where('users.email','=',$email)
          ->count();
          if ($lista>0) {
              $data=['estado'=>'No_disponible'];
          }else{
              $data=['estado'=>'Disponible'];
          }
          return response()->json($data);
        }

        public function ActualizaContrasena(Request $request)
        {
            $id=request('IdUsuarioClave');
            $obj=User::findOrFail($id);
            $obj->password=bcrypt($request->input('passwordchange'));
            $obj->save();
            $data=["Mensaje"=>"Ok"];
            return response()->json($data);
        }
}