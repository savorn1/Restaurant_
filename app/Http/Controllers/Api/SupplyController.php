<?php

namespace App\Http\Controllers\Api;

use App\Models\Supply;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SupplyController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term) {
            $results = Supply::where('supply_name', 'LIKE', '%' . $search_term . '%')
                //->orWhere('description', 'LIKE', '%' . $search_term . '%')
                ->paginate(50);
        } else {
            $results = Supply::paginate(50);
        }

        return $results;

    }

    public function show($id)
    {
        return Supply::find($id);
    }
}
