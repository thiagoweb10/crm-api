<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use App\Jobs\ExportJob;
use App\Models\Priority;
use Illuminate\Http\Request;
use App\Jobs\StoreExportDataJob;
use App\Http\Controllers\Controller;
use App\Exports\PrioritieExportMethod;
use App\Services\Prioritie\PrioritieService;
use App\Http\Requests\Prioritie\CreateRequest;
use App\Http\Requests\Prioritie\UpdateRequest;

class PriorityController extends Controller
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
                ,'data'  =>  (new PrioritieService())->index()
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
                ,'data'  =>  (new PrioritieService())->store($request)
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
    public function show(Priority $priority)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new PrioritieService())->show($priority)
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
    public function update(UpdateRequest $request, Priority $priority)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new PrioritieService())->update($request, $priority)
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
    public function destroy(Priority $priority)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new PrioritieService())->destroy($priority)
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
            $filename = "CRM-Sistemas-".now()->format('Y-m-d-H_i').".xlsx";

            StoreExportDataJob::withChain([
                (new ExportJob($oUser, $filename, new PrioritieExportMethod($request->all()))),
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
