<?php 
namespace App\Services\Demand;

use App\Models\Demand;


class DemandService {

    public function getData($request)
    {
        $oDemand  = Demand::with(['priority','request','sistem','status','createdBy','developer']);
        $oDemands = $this->getDataFilter($oDemand, $request);
        $oDemands = $oDemands->paginate(20);

        return response()->json($oDemands, 200);
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

    public function show($id)
    {
        $aDemand = Demand::find($id);

        return $aDemand;
    }

    public function store($data)
    {
        Demand::create($data);

        return ['status' => 'Demanda cadasrada com sucesso!'];
    }

    public function update($request, $demand)
    {
        $data = $request->validated();
        $demand->update($data);

        return ['status' => 'Registro alterado com sucesso!'];
    }

    public function destroy($demand)
    {
        try {
            $demand->delete();

            return ['status' => 'success'];
        } catch (\Exception $e) {
            return ['error' => true, 'message' => $e->getMessage()];
        }
    }
}