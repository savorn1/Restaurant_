<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;


class ProductCategoryController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');


        if ($search_term)
        {
            $results = ProductCategory::where('title', 'LIKE', '%'.$search_term.'%')->paginate(100);
        }
        else
        {
            $results =  ProductCategory::paginate(100);
        }
//        dd($results);

        return $results;
    }

    public function show($id)
    {
        return ProductCategory::find($id);
    }
}
