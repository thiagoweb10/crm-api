<?php

namespace App\Exports;

use App\Interfaces\ExportMethodInterface;
use App\Services\System\SystemService;

class SystemExportMethod implements ExportMethodInterface {

    public function __construct(
        protected Array $request,
        protected SystemService $service = new SystemService(),
    ){}

    public function makeExport()
    {
        return $this->service->index();
    }
}