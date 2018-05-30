<?php

namespace App\Http\Controllers\Api;

use App\Models\Ministry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MinistryController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term) {
            $results = Ministry::orWhere('title', 'LIKE', '%' . $search_term . '%')
                ->orWhere('description', 'LIKE', '%' . $search_term . '%')
                ->paginate(100);
        } else {
            $results = Ministry::paginate(100);
        }

        return $results;

    }

    public function show($id)
    {
        return Ministry::find($id);
    }
}
