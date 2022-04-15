<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Estado;
use App\Models\Municipio;
use App\Models\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(Auth::check())
        {
            $totalEstados = Estado::count();
            $totalMunicipios = Municipio::count();
            $totalUsuarios = User::count();

            $estadoSelect = Estado::first(['estadoId', 'nombreEstado']);

            if($estadoSelect != null)
            {
                $idInicial = $estadoSelect->estadoId;
                $municipiosEstado = Municipio::where('estado_id',$idInicial)->count();
                $data[0]= array(
                    'label' => $estadoSelect->nombreEstado,
                    'value' => $municipiosEstado
                );
                
                for($i=1;$i<$totalEstados;$i++){
                    $estadoNow = Estado::where('estadoId','>',$idInicial)->orderBy('estadoId','asc')->first(['estadoId', 'nombreEstado']);
                    $idInicial = $estadoNow->estadoId;
                    $municipiosNow = Municipio::where('estado_id',$idInicial)->count();
                    $data[$i]= array(
                        'label' => $estadoNow->nombreEstado,
                        'value' => $municipiosNow
                    );
                }
            }
            else
            {
                $data[0]= array(
                    'id' => null,
                    'nombre' => null,
                    'count' => null
                );
            }
            return view('dashboard.index', compact(['data','totalEstados','totalMunicipios','totalUsuarios']));
        }
        else
        {
            return redirect('/login');
        }
    }
}
