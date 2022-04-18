<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use Response;
use DataTables;
use Illuminate\Support\Facades\Validator;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = Estado::select('id','nombreEstado','claveEstado','codigoEstado')->get();
        if ($request->ajax()) {
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id.'" data-original-title="Editar" class="btn btn-primary" id="showEstadoBtn"><i class="fas fa-edit"></i></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row->id.'" data-original-title="Eliminar" class="btn btn-danger" id="deleteEstadoBtn"><i class="fas fa-trash"></i></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view("dashboard.tables.estados",compact('data'));
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
            'estado' => 'required|min:8|max:35',
            'claveInegi' => 'required|max:4',
            'codigoIso' => 'required|max:4'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->ajax()){
            $newEstado = new Estado;
            $newEstado->nombreEstado = $request->input('estado');
            $newEstado->claveEstado = $request->input('claveInegi');
            $newEstado->codigoEstado = $request->input('codigoIso');
            $newEstado->save();
            return response()->json(
                $newEstado->toArray());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $estadoID = $request->id;
        $estado = Estado::find($estadoID);
        return response()->json(['details'=>$estado]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function edit(Estado $estado)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Estado $estado)
    {
        $rules = array(
            'estado' => 'required|min:8|max:35',
            'claveInegi' => 'required|max:4',
            'codigoIso' => 'required|max:4'
        );

        $error = Validator::make($request->all(), $rules);

        if($error->fails()){
            return response()->json(['errors' => $error->errors()->all()]);
        }

        if($request->ajax()){
            $estadoEdit = Estado::find($request->input('estadoID'));
            $estadoEdit->nombreEstado = $request->input('estado');
            $estadoEdit->claveEstado = $request->input('claveInegi');
            $estadoEdit->codigoEstado = $request->input('codigoIso');
            $estadoEdit->save();
            return response()->json(
                $estadoEdit->toArray());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Estado  $estado
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $estadoID = $request->id;
        $estadoDelete = Estado::find($estadoID)->delete();
        return response()->json(['msg'=>'Eliminado']);
    }
}
