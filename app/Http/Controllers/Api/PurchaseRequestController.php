<?php

namespace App\Http\Controllers\Api;

use App\Models\PurchaseRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PurchaseRequestController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term) {
            $results = PurchaseRequest::orWhere('request_number', 'LIKE', '%' . $search_term . '%')
                ->orWhere('purchase_request_details', 'LIKE', '%' . $search_term . '%')
                ->paginate(100);
        } else {
            $results = PurchaseRequest::paginate(100);
        }

        return $results;

    }

    public function show($id)
    {
        return PurchaseRequest::find($id);
    }
}
