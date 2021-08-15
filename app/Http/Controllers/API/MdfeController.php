<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Mdfe;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class MdfeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        try {
            $mdfes = Mdfe::where('status', '1')->paginate(getenv('PAGINATE'));
            $minus30days = minusDays();
            $date = date('d/m/Y');
            $response = [
                'data' => $mdfes
            ];
        } catch (\Exception $exception) {
            $response = $exception;
        }

        return response($response);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Mdfe $mdfe
     * @return Response
     */
    public function show(Mdfe $mdfe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Mdfe $mdfe
     * @return Response
     */
    public function update(Request $request, Mdfe $mdfe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Mdfe $mdfe
     * @return Response
     */
    public function destroy(Mdfe $mdfe)
    {
        //
    }
}
