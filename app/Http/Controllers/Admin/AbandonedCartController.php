<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartStorage;
use Illuminate\Http\Request;

class AbandonedCartController extends Controller
{
    public function index()
    {
        $carts = CartStorage::with('user')->paginate(10);

        return view('admin.abandoned-carts.index', compact('carts'));
    }
}
