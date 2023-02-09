<?php

namespace App\Exports;

use App\Interfaces\ExportMethodInterface;
use App\Services\Prioritie\PrioritieService;

class PrioritieExportMethod implements ExportMethodInterface {

    public function __construct(
        protected Array $request,
        protected PrioritieService $service = new PrioritieService(),
    ){}

    public function makeExport()
    {
        return $this->service->index();
    }
}