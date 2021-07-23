<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        
    }
	
	public function form(){
		
		$tipos = Vehicle::tipos();
		$tiposRodado = Vehicle::tiposRodado();
		$tiposCarroceria = Vehicle::tiposCarroceria();
		$tiposProprietario = Vehicle::tiposProprietario();
		
		$ufs = Vehicle::cUF();
		
		$data = [
			'tipos' => $tipos,
			'tiposRodado'=> $tiposRodado,
			'tiposCarroceria' => $tiposCarroceria,
			'tiposProprietario' => $tiposProprietario,
			'ufs' => $ufs,
		];
		
		$response = [
			'infos' => $data
		];
		
		return response($response);
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {

    	
	    $request->validate([
		    'placa' => 'required|max:8',
		    'cor' => 'required|max:10',
		    'marca' => 'required|max:20',
		    'modelo' => 'required|max:20',
		    'tara' => 'required|max:10',
		    'rntrc' => 'required|min:8',
		    'capacidade' => 'required|max:10',
		    'proprietario_nome' => 'required|max:40',
		    'proprietario_uf' => 'required|max:40',
		    'proprietario_ie' => 'required|max:13',
		    'proprietario_documento' => 'required|max:20',
	    ]);
    	$response = [
    		'message' => 'ok'
	    ];
        return response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return Response
     */
    public function show(Vehicle $vehicle)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\Models\Vehicle  $vehicle
     * @return Response
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehicle  $vehicle
     * @return Response
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }
}
