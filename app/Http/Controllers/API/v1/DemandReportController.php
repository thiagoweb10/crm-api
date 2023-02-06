<?php

namespace App\Http\Controllers\API\v1;

use App\Models\User;
use App\Jobs\ExportJob;
use App\Jobs\StoreExportDataJob;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemandReportController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    public function show(Request $request)
    {
        try {
            $oUser = User::find(1);
            $result['status'] = 200;            
            $filename = "CRM-Demandas-".now()->format('Y-m-d-H_i').".xlsx";

            StoreExportDataJob::withChain([
                (new ExportJob($oUser, $filename, $request->all()))
            ])->dispatch($oUser, $filename);

            $result['data'] = 'Seu arquivo foi enviado para processamento e em breve estara disponivel na pagina de Relatorios.';
            
        } catch (\Exception $e) {
            $result = [
                'status' => 500
                ,'error' => $e->getMessage()
            ];
        } 

        return response()->json($result, $result['status']);
    }
}