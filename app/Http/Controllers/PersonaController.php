<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DataTables;
use App\Models\User;
use App\Models\Estado;
use App\Models\Municipio;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class PersonaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::select('id','nombre','apellidoPaterno','apellidoMaterno','fechaNacimiento','edad','rfc','curp','email','telefono','celular','estado_id','municipio_id')->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addColumn('Estado', function(User $user){
                    return $user->estados->codigoEstado;
                })
                ->addColumn('Municipio', function(User $user){
                    return $user->municipios->nombreMunicipio;
                })
                ->addColumn('action', function(User $user){
                    $btn = '<a href="javascript:void(0)" data-id="'.$user->id.'" data-original-title="Editar" class="btn btn-primary" id="showUserBtn"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id="'.$user->id.'" data-original-title="Eliminar" class="btn btn-danger" id="deleteUserBtn"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
        return view("dashboard.tables.personas",compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = array(
            'nombre' => 'required|min:2|max:35',
            'apellidoPaterno' => 'required|min:4|max:25',
            'apellidoMaterno' => 'max:25',
            'fechaNacimiento' => 'required',
            'rfc' => 'required|min:13|max:13',
            'curp' => 'required|min:18|max:18',
            'telefono' => 'required|min:10|max:10',
            'celular' => 'required|min:10|max:10',
            'correo' => 'required|min:10|max:80',
            'edad' => 'required|min:2|max:2',
            'passw' => 'required|min:8',
            'claveInegiE' => 'required|min:2|max:4',
            'claveInegiM' => 'required|min:2|max:5'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->ajax()){
            $newPersona = new User;
            $newPersona->nombre = $request->input('nombre');
            $newPersona->apellidoPaterno = $request->input('apellidoPaterno');
            $newPersona->apellidoMaterno = $request->input('apellidoMaterno');
            $newPersona->fechaNacimiento = $request->input('fechaNacimiento');
            $newPersona->rfc = $request->input('rfc');
            $newPersona->curp = $request->input('curp');
            $newPersona->telefono = $request->input('telefono');
            $newPersona->celular = $request->input('celular');
            $newPersona->email = $request->input('correo');
            $newPersona->edad = $request->input('edad');
            $newPersona->password = Hash::make($request->input('passw'));
            $newPersona->estado_id = $request->input('claveInegiE');
            $newPersona->municipio_id = $request->input('claveInegiM');
            $newPersona->save();
            return response()->json(
                $newPersona->toArray());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $personaID = $request->id;
        $persona = User::find($personaID);
        return response()->json(['details'=>$persona]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $rules = array(
            'nombre' => 'required|min:2|max:35',
            'apellidoPaterno' => 'required|min:4|max:25',
            'apellidoMaterno' => 'max:25',
            'fechaNacimiento' => 'required',
            'rfc' => 'required|min:13|max:13',
            'curp' => 'required|min:18|max:18',
            'telefono' => 'required|min:10|max:10',
            'celular' => 'required|min:10|max:10',
            'correo' => 'required|min:10|max:80',
            'edad' => 'required|min:2|max:2',
            'passw' => 'required|min:8',
            'claveInegiE' => 'required|min:2|max:4',
            'claveInegiM' => 'required|min:2|max:5'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->ajax()){
            $personaEdit = User::find($request->input('personaID'));
            $personaEdit->nombre = $request->input('nombre');
            $personaEdit->apellidoPaterno = $request->input('apellidoPaterno');
            $personaEdit->apellidoMaterno = $request->input('apellidoMaterno');
            $personaEdit->fechaNacimiento = $request->input('fechaNacimiento');
            $personaEdit->rfc = $request->input('rfc');
            $personaEdit->curp = $request->input('curp');
            $personaEdit->telefono = $request->input('telefono');
            $personaEdit->celular = $request->input('celular');
            $personaEdit->email = $request->input('correo');
            $personaEdit->edad = $request->input('edad');
            $personaEdit->estado_id = $request->input('claveInegiE');
            $personaEdit->municipio_id = $request->input('claveInegiM');
            $personaEdit->save();
            return response()->json(
                $personaEdit->toArray());
        }
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $personaID = $request->id;
        $personaDelete = User::find($personaID)->delete();
        return response()->json(['msg'=>'Eliminado']);
    }
}