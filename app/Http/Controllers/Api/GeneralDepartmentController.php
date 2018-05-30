<?php

namespace App\Http\Controllers\Api;

use App\Models\GeneralDepartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class GeneralDepartmentController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        $ministry = $request->ministry;

        if ($search_term) {
            $results = GeneralDepartment::where('ministry_id', $ministry)
                ->where(function ($q) use ($search_term) {
                    $q->orWhere('title', 'LIKE', '%' . $search_term . '%')->orWhere('description', 'LIKE', '%' . $search_term . '%');
                })->paginate(100);
        } else {
            $results = GeneralDepartment::where('ministry_id', $ministry)->paginate(100);
        }

        return $results;

    }

    public function show($id)
    {
        return GeneralDepartment::find($id);
    }
}
