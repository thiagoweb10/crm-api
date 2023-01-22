<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\DemandStatus;
use Illuminate\Http\Request;

class DemandStatusController extends Controller
{
    public function index()
    {
        $status = DemandStatus::get();

        return response()->json($status, 200);
    }
}
