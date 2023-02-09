<?php 
namespace App\Services\Request;

use App\Models\Request;
use App\Http\Requests\Request\CreateRequest;
use App\Http\Requests\Request\UpdateRequest;

class RequestService {

public function index()
{
    return  Request::all();
}

public function store(CreateRequest $request)
{
    return Request::create($request->validated());
}

public function show(Request $system)
{
    return $system;
}

public function update(UpdateRequest $request, Request $system)
{
    return $system->update($request->validated());
}

public function destroy(Request $system)
{
    return $system->delete();
}

}