<?php 
namespace App\Services\Prioritie;

use App\Models\Priority;
use App\Http\Requests\Prioritie\CreateRequest;
use App\Http\Requests\Prioritie\UpdateRequest;

class PrioritieService {

    public function index()
    {
        return Priority::all();
    }

    public function store(CreateRequest $request)
    {
        return Priority::create($request->validated());
    }

    public function show(Priority $priority)
    {
        return $priority;
    }

    public function update(UpdateRequest $request, Priority $priority)
    {
        return $priority->update($request->validated());
    }

    public function destroy(Priority $priority)
    {
        return $priority->delete();
    }

}