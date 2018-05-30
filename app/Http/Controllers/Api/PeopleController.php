<?php

namespace App\Http\Controllers\Api;

use App\Models\People;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PeopleController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term) {
            $results = People::orWhere('full_name', 'LIKE', '%' . $search_term . '%')
                ->orWhere('email', 'LIKE', '%' . $search_term . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $search_term . '%')
                ->paginate(100);
        } else {
            $results = People::paginate(100);
        }

        return $results;

    }

    public function show($id)
    {
        return People::find($id);
    }
}
