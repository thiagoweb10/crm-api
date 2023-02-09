<?php 
namespace App\Services\Department;

use App\Models\Department;
use App\Http\Requests\Department\CreateRequest;
use App\Http\Requests\Department\UpdateRequest;

class DepartmentService {

    public function index()
    {
        return  Department::all();
    }

    public function store(CreateRequest $request)
    {
        return Department::create($request->validated());
    }

    public function show(Department $department)
    {
        return $department;
    }

    public function update(UpdateRequest $request, Department $department)
    {
        return $department->update($request->validated());
    }

    public function destroy(Department $department)
    {
        return $department->delete();
    }

}