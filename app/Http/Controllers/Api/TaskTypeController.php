<?php

namespace App\Http\Controllers\Api;


use App\Models\TaskType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class TaskTypeController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');


        if ($search_term) {
            $results = TaskType::where('title', 'LIKE', '%' . $search_term . '%')->paginate(100);
        } else {
            $results = TaskType::paginate(100);
        }
//        dd($results);

        return $results;
    }

    public function show($id)
    {
        return TaskType::find($id);
    }
}
