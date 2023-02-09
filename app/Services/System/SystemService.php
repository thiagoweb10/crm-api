<?php 
namespace App\Services\System;

use App\Models\System;
use Illuminate\Http\Request;
use App\Http\Requests\System\CreateRequest;
use App\Http\Requests\System\UpdateRequest;



class SystemService {

    public function index()
    {
        return  System::all();
    }

    public function store(CreateRequest $request)
    {
        return System::create($request->validated());
    }

    public function show(System $system)
    {
        return $system;
    }

    public function update(UpdateRequest $request, System $system)
    {
        return $system->update($request->validated());
    }

    public function destroy(System $system)
    {
        return $system->delete();
    }

    protected function getDataFilter($oSystem, $request)
    {
    
    }


}