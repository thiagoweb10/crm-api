<?php 
namespace App\Services\Demand;

use App\Models\Demand;

class DemandService {

    public function getDataAllReport()
    {
        $oDemand  = Demand::with(['priority','request','sistem','status','createdBy','developerBy']);
        $oDemands = $oDemand->get()->toArray();

        return $oDemands;
    }

    public function getData($request, $btoExport = null)
    {
        $oDemand  = Demand::with(['priority','request','sistem','status','createdBy','developerBy']);
        $oDemands = $this->getDataFilter($oDemand, $request);
        $oReportData = (!is_null($btoExport)) ?  $oDemands->get() : $oDemands->paginate(20);

        return $oReportData;
    }

    protected function getDataFilter($oDemand, $request)
    {
        if (!is_null($oDemand)) {
            $oFilter = $oDemand;
            foreach (['status_id', 'developer_id', 'request_id', 'priority_id', 'system_id', 'developer_id', 'status_id'] as $column) {
                if (array_key_exists($column, $request)) {
                    $oFilter = $oDemand->where($column, $request[$column]);
                }
            }
        }

        return $oFilter;
    }

    public function getDataByID($demand)
    {   
        return Demand::find($demand);
    }

    public function store($data)
    {
        Demand::create($data)->log()->create($data);

        return 'Demanda cadastrada com sucesso!';
    }

    public function update($request, $demand)
    {
        $demand->update($request->validated());
        
        $demand->log()->create($request->validated());

        return 'Registro alterado com sucesso!';
    }

    public function destroy($demand)
    {
        $demand->delete();

        return 'Demanda excluída com sucesso!';
    }
}