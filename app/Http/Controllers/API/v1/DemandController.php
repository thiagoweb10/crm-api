<?php

namespace App\Http\Controllers\API\v1;

use App\Models\Demand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\Demand\DemandService;
use App\Http\Requests\Demand\CreateRequest;
use App\Http\Requests\Demand\UpdateRequest;

class DemandController extends Controller
{
    public function index(Request $request)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new DemandService())->getData($request)
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

       return response()->json($result, $result['status']);
    }

    public function show($demand)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  => (new DemandService())->getDataByID($demand)
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        } 

        return response()->json($result, $result['status']);
    }

    public function store(CreateRequest $request)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  => (new DemandService())->store($request->validated())
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function update(UpdateRequest $request, Demand $demand)
    {
        try {

            $data   = $request->validated();
            $result = [
                'status' => 200
                ,'data'  => (new DemandService())->update($request, $demand, $data)
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function destroy(Demand $demand)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  => (new DemandService())->destroy($demand)
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

        return response()->json($result['data'], $result['status']);
    }
}