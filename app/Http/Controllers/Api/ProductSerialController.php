<?php

namespace App\Http\Controllers\Api;

use App\Models\ProductSerial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductSerialController extends Controller
{

    public function index(Request $request)
    {
        $product_id = $request->product_id;
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term) {
            $results = ProductSerial::where('product_id',$product_id)
                ->where('status','free')
                ->where(function ($query) use ($search_term){
                    $query->orWhere('serial_code', 'LIKE', '%' . $search_term . '%')
                        ->orWhere('option', 'LIKE', '%' . $search_term . '%');
                })->paginate(100);
        } else {
            $results = ProductSerial::where('product_id',$product_id)->where('status','free')->paginate(100);
        }

        return $results;

    }

    public function show($id)
    {
        return ProductSerial::find($id);
    }
}
