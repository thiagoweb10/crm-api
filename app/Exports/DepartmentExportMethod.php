<?php

namespace App\Exports;

use App\Interfaces\ExportMethodInterface;
use App\Services\Department\DepartmentService;

class DepartmentExportMethod implements ExportMethodInterface {

    public function __construct(
        protected Array $request,
        protected DepartmentService $service = new DepartmentService(),
    ){}

    public function makeExport()
    {
        return $this->service->index();
    }
}