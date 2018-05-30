<?php

namespace App\Http\Controllers\Api;

use App\Models\Source;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SourceController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term) {
            $results = Source::where('source_name', 'LIKE', '%' . $search_term . '%')
                //->orWhere('description', 'LIKE', '%' . $search_term . '%')
                ->paginate(30);
        } else {
            $results = Source::paginate(30);
        }

        return $results;

    }

    public function show($id)
    {
        return Source::find($id);
    }
}
