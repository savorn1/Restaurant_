<?php

namespace App\Http\Controllers\Api;

use App\Models\Office;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OfficeController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');
        $department = $request->department;

        if ($search_term) {
            $results = Office::where('department_id', $department)
                ->where(function ($q) use ($search_term) {
                    $q->orWhere('title', 'LIKE', '%' . $search_term . '%')->orWhere('description', 'LIKE', '%' . $search_term . '%');
                })->paginate(100);
        } else {
            $results = Office::where('department_id', $department)->paginate(100);
        }

        return $results;

    }

    public function show($id)
    {
        return Office::find($id);
    }
}
