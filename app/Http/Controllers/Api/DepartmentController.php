<?php

namespace App\Http\Controllers\Api;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');
        $general_department = $request->general_department;

        if ($search_term) {
            $results = Department::where('general_dep_id', $general_department)
                ->where(function ($q) use ($search_term) {
                    $q->orWhere('title', 'LIKE', '%' . $search_term . '%')->orWhere('description', 'LIKE', '%' . $search_term . '%');
                })->paginate(100);
        } else {
            $results = Department::where('general_dep_id', $general_department)->paginate(100);
        }

        return $results;

    }

    public function show($id)
    {
        return Department::find($id);
    }
}
