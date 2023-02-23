<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserDetailsController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('tosearch');
        $perPage = 3;
        $data = User::where('first_name', 'LIKE', '%' . $q . '%')
            ->orwhere('last_name', 'LIKE', '%' . $q . '%')
            ->orwhere('email', 'LIKE', '%' . $q . '%')
            ->paginate($perPage);
        $metadata = [
            'current_url' => $request->fullUrl(),
            'next_url' => $data->nextPageUrl(),
            'total_pages' => $data->lastPage(),
        ];
        return [
            'item' => $data,
        ];
    }
}
