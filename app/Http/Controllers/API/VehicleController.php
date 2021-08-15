<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Veiculo;
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
        return Veiculo::where('ativo', 1)->paginate(10);
    }

	public function form(){

		$tipos = Veiculo::tipos();
		$tiposRodado = Veiculo::tiposRodado();
		$tiposCarroceria = Veiculo::tiposCarroceria();
		$tiposProprietario = Veiculo::tiposProprietario();

		$ufs = Veiculo::cUF();

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
		    'placa' => 'required|max:8|unique:vehicles,placa',
		    'uf' => 'required',
		    'cor' => 'required|max:10',
		    'marca' => 'required|max:20',
		    'modelo' => 'required|max:20',
		    'tara' => 'required|max:10',
		    'rntrc' => 'required|min:8',
		    'capacidade' => 'required|max:10',
		    'proprietario_nome' => 'required|max:40',
		    'proprietario_ie' => 'required|max:13',
		    'proprietario_documento' => 'required|max:14',
	    ]);
        $vehicle = Veiculo::create($request->all());

    	$response = [
    		'message' => 'ok',
            'data' => $vehicle
	    ];
        return response($response);
    }

    /**
     * Display the specified resource.
     *
     * @param Veiculo $vehicle
     * @return Response
     */
    public function show(Veiculo $vehicle): Response
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Veiculo $vehicle
     * @return Response
     */
    public function update(Request $request, Veiculo $vehicle): Response
    {
        $vehicle->fill($request->all());
        $vehicle->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Veiculo $vehicle
     * @return void
     */
    public function destroy(Veiculo $vehicle)
    {
        //
    }
}
