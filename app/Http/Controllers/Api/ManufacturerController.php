<?php

namespace App\Http\Controllers\Api;

use App\Models\Manufacturer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ManufacturerController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term) {
            $results = Manufacturer::orWhere('title', 'LIKE', '%' . $search_term . '%')
                //->orWhere('description', 'LIKE', '%' . $search_term . '%')
                ->paginate(100);
        } else {
            $results = Manufacturer::paginate(100);
        }

        return $results;

    }

    public function show($id)
    {
        return Manufacturer::find($id);
    }
}
