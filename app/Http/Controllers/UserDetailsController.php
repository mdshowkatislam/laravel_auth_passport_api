<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserDetailsController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->input('tosearch');
        $perPage = 3;

        if (!empty(Auth::guard('api')->user())) {
            $data = User::where('first_name', 'LIKE', "%{$q}%")
                ->orwhere('last_name', 'LIKE', "%{$q}%")
                ->orwhere('email', 'LIKE', "%{$q}%")
                ->paginate($perPage);
        }
        $items = $data->map(function ($item) {
            return [
                'uuid' => $item->id,
                'name' => $item->first_name . '' . $item->last_name,
            ];
        });

        $metadata = [
            'current_url' => $request->fullUrl(),
            'next_url' => $data->nextPageUrl(),
            'total_pages' => $data->lastPage(),
        ];
        return [
            'item' => $items,
            'metadata' => $metadata,
        ];
    }
}
