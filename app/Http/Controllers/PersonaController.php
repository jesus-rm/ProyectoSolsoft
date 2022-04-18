<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Response;
use DataTables;
use App\Models\User;
use App\Models\Estado;
use App\Models\Municipio;

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
    
}