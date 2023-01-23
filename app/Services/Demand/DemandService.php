<?php 
namespace App\Services\Demand;

use App\Models\Demand;


class DemandService {

    public $demand;

    function __construct(Demand $demand = null) 
    {
       (is_null($demand)) ??  $this->demand = $demand;
    }

    public function getData($request)
    {
        $oDemand  = Demand::with(['priority','request','sistem','status','createdBy','developer']);
        $oDemands = $this->getDataFilter($oDemand, $request);
        $oDemands = $oDemands->paginate(20);

        return $oDemands;
    }

    protected function getDataFilter($oDemand, $request)
    {
        if (!is_null($oDemand)) 
        {
            foreach (['status_id'=>'status', 'developer_id'=>'developer', 'request_id'=>'type_request'] as $column => $value) {
                if ($request->input($value) > 0) {
                    $oDemand .= $oDemand->where($column, $request->input($value));
                }
            }
        }

        return $oDemand;
    }

    public function getDataByID($demand)
    {   
        return Demand::find($demand);
    }

    public function store($data)
    {
        Demand::create($data);

        return 'Demanda cadastrada com sucesso!';
    }

    public function update($request, $demand)
    {
        $data = $request->validated();
        $demand->update($data);

        return  'Registro alterado com sucesso!';
    }

    public function destroy($demand)
    {
        $demand->delete();

        return  'Demanda excluida com sucesso!';
    }
}