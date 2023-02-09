<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use App\Jobs\ExportJob;
use Illuminate\Http\Request;
use App\Jobs\StoreExportDataJob;
use App\Exports\RequestExportMethod;
use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use App\Services\Request\RequestService;
use App\Http\Requests\Request\CreateRequest;
use App\Http\Requests\Request\UpdateRequest;

class RequestController extends Controller
{
        /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new RequestService())->index()
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

       return response()->json($result, $result['status']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new RequestService())->store($request)
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ModelsRequest $system)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new RequestService())->show($system)
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, ModelsRequest $system)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new RequestService())->update($request, $system)
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ModelsRequest $system)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new RequestService())->destroy($system)
            ];

        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function export(Request $request)
    {
        try {
            $oUser = User::find(1);
            $result['status'] = 200;            
            $filename = "CRM-Solicitações-".now()->format('Y-m-d-H_i').".xlsx";

            StoreExportDataJob::withChain([
                (new ExportJob($oUser, $filename, new RequestExportMethod($request->all()))),
            ])->dispatch($oUser, $filename);

            $result['data'] = 'Seu arquivo foi enviado para processamento e em breve estará disponível na pagina de Relatórios.';
            
        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        } 

        return response()->json($result, $result['status']);
    }
}
