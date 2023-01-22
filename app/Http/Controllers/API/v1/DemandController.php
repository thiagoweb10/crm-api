<?php

namespace App\Http\Controllers\API\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Demand\DemandService;
use App\Http\Requests\Demand\CreateRequest;
use App\Models\Demand;

class DemandController extends Controller
{
    public function index(Request $request)
    {
        $oDemands = (new DemandService())->getData($request);

        return response()->json($oDemands, 200); 
    }

    public function store(CreateRequest $request)
    {
        $data    = $request->validated();
        $aReturn = (new DemandService())->store($data);
        
        return response()->json($aReturn, 200);
    }

    public function update(UpdateRequest $request, Demand $demand)
    {
        $data    = $request->validated();
        $aReturn = (new DemandService())->update($request, $demand, $data);

        return response()->json($aReturn, 200);
    }
}