<?php

namespace App\Exports;

use App\Services\Request\RequestService;
use App\Interfaces\ExportMethodInterface;

class RequestExportMethod implements ExportMethodInterface {

    public function __construct(
        protected Array $request,
        protected RequestService $service = new RequestService(),
    ){}

    public function makeExport()
    {
        return $this->service->index();
    }
}