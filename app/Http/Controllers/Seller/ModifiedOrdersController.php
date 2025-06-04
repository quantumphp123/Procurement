<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

class ModifiedOrdersController extends Controller
{

    // Get Modified Orders
    public function index()
    {
        return view('seller.modified-orders.index');
    }


    // Show Modified Orders
    public function show()
    {
        return view('seller.modified-orders.show');
    }
}
