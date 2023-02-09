<?php

namespace App\Exports;

use App\Interfaces\ExportMethodInterface;

class ExportProcess {

    protected  $exportMethod;

    public function __construct(ExportMethodInterface $exportMethod)
    {
        $this->exportMethod = $exportMethod;
    }

    public function export()
    {
        return $this->exportMethod->makeExport();
    }

}