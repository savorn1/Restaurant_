<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Models\CustomerAccount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;


class SearchCustomerController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term) {
            $results = CustomerAccount::orWhere('account_number', 'LIKE', '%' . $search_term . '%')
                ->orWhere('customer_name', 'LIKE', '%' . $search_term . '%')
                ->orWhere('customer_name_kh', 'LIKE', '%' . $search_term . '%')
                ->orWhere('family_book_number', 'LIKE', '%' . $search_term . '%')
                ->orWhere('identity_number', 'LIKE', '%' . $search_term . '%')
                ->orWhere('phone_number', 'LIKE', '%' . $search_term . '%')
                ->paginate(100);
        } else {
            $results = CustomerAccount::paginate(100);
        }

        return $results;

    }

    public function show($id)
    {
        return CustomerAccount::find($id);
    }

}
