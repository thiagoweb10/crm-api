<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function index()
    {
		$requests = ModelsRequest::get();

		return response()->json($requests ,200);
    }
}
