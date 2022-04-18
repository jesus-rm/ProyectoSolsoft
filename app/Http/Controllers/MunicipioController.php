<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;
use Response;
use DataTables;
use App\Models\Estado;
use Illuminate\Support\Facades\Validator;

class MunicipioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            if(!empty($request->filtroEstados))
            {
                $estadoOption = Estado::where('nombreEstado',$request->filtroEstados)->value('id');
                $data = Municipio::where('estado_id',$estadoOption)->select('id','nombreMunicipio','claveMunicipio','estado_id')->get();
            }
            else
            {
                $data = Municipio::select('id','nombreMunicipio','claveMunicipio','estado_id')->get();
            }
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Estado', function(Municipio $municipio){
                    return $municipio->estados->nombreEstado;
                })
                ->addColumn('action', function(Municipio $municipio){
                    $btn = '<a href="javascript:void(0)" data-id="'.$municipio->id.'" data-original-title="Editar" class="btn btn-primary" id="showMunicipioBtn"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id="'.$municipio->id.'" data-original-title="Eliminar" class="btn btn-danger" id="deleteMunicipioBtn"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        $data = Municipio::select('id','nombreMunicipio','claveMunicipio','estado_id')->get();
        $estados = Estado::select('id','nombreEstado')->orderby('nombreEstado','ASC')->get();
        return view("dashboard.tables.municipios",compact(['data','estados']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'municipio' => 'required|min:8|max:50',
            'claveInegi' => 'required|max:4',
            'claveEstado' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->ajax()){
            $newMunicipio = new Municipio;
            $newMunicipio->nombreMunicipio = $request->input('municipio');
            $newMunicipio->claveMunicipio = $request->input('claveInegi');
            $newMunicipio->estado_id = $request->input('claveEstado');
            $newMunicipio->save();
            return response()->json(
                $newMunicipio->toArray());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $municipioID = $request->id;
        $municipio = Municipio::find($municipioID);
        return response()->json(['details'=>$municipio]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function edit(Municipio $municipio)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Municipio $municipio)
    {
        $rules = array(
            'municipio' => 'required|min:8|max:50',
            'claveInegi' => 'required|max:4',
            'claveEstado' => 'required'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->ajax()){
            $municipioEdit = Municipio::find($request->input('municipioID'));
            $municipioEdit->nombreMunicipio = $request->input('municipio');
            $municipioEdit->claveMunicipio = $request->input('claveInegi');
            $municipioEdit->estado_id = $request->input('claveEstado');
            $municipioEdit->save();
            return response()->json(
                $municipioEdit->toArray());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Municipio  $municipio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $municipioID = $request->id;
        $municipioDelete = Municipio::find($municipioID)->delete();
        return response()->json(['msg'=>'Eliminado']);
    }
}
