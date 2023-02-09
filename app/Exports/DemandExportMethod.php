<?php

namespace App\Exports;

use App\Interfaces\ExportMethodInterface;
use App\Services\Demand\DemandService;

class DemandExportMethod implements ExportMethodInterface {

    public function __construct(
        protected Array $request,
        protected DemandService $service = new DemandService(),
    ){}

    public function makeExport()
    {
        return $this->service->getData($this->request, true);
    }
}