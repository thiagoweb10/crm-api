<?php

namespace App\Http\Controllers;

use App\Models\Demand;
use Illuminate\Http\Request;
use App\Models\API\v1\Export;
use Illuminate\Support\Facades\Storage;

class ExportController extends Controller
{
    //

    public function index()
    {
        $export = Export::all();

        return $export;
    }

    public function show($export)
    {
        $export = Export::find($export);

        return Storage::download($export->file_name);
    }

}
