<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use App\Jobs\ExportJob;
use App\Models\Department;
use Illuminate\Http\Request;
use App\Jobs\StoreExportDataJob;
use App\Http\Controllers\Controller;
use App\Exports\DepartmentExportMethod;
use App\Services\Department\DepartmentService;
use App\Http\Requests\Department\CreateRequest;
use App\Http\Requests\Department\UpdateRequest;

class DepartmentController extends Controller
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
                ,'data'  =>  (new DepartmentService())->index()
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
                ,'data'  =>  (new DepartmentService())->store($request)
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
    public function show(Department $department)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new DepartmentService())->show($department)
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
    public function update(UpdateRequest $request, Department $department)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new DepartmentService())->update($request, $department)
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
    public function destroy(Department $department)
    {
        try {

            $result = [
                'status' => 200
                ,'data'  =>  (new DepartmentService())->destroy($department)
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
                (new ExportJob($oUser, $filename, new DepartmentExportMethod($request->all()))),
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
