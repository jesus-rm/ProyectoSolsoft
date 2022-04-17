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
        $data = User::all();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addColumn('Estado', function(User $user){
                    return $user->estados->nombreEstado;
                })
                ->addColumn('Municipio', function(User $user){
                    return $user->municipios->nombreMunicipio;
                })
                ->addIndexColumn()
                ->make(true);
        }
        return view("dashboard.tables.personas",compact('data'));
    }
    
}