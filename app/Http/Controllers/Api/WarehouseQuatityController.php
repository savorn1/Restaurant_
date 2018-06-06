<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Warehouse;

class WarehouseQuatityController extends Controller
{
    //

    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term)
        {
            $results = Warehouse::where('name', 'LIKE', '%'.$search_term.'%')->paginate(10);
        }
        else
        {
            $results = Warehouse::paginate(10);
        }

        return $results;
    }

    public function show($id)
    {
        return Warehouse::find($id);
    }
}
