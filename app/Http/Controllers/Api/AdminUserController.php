<?php

namespace App\Http\Controllers\Api;

use App\Models\AdminUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $search_term = $request->input('q');
        $page = $request->input('page');

        if ($search_term) {
            $results = AdminUser::orWhere('name', 'LIKE', '%' . $search_term . '%')
                ->orWhere('email', 'LIKE', '%' . $search_term . '%')
                ->orWhere('phone', 'LIKE', '%' . $search_term . '%')
                ->paginate(100);
        } else {
            $results = AdminUser::paginate(100);
        }

        return $results;

    }

    public function show($id)
    {
        return AdminUser::find($id);
    }
}
