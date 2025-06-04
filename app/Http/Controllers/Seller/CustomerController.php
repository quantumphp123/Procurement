<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    // Load the customer view page
    public function index()
    {
        return view('seller.customer.index');
    }

    // Load the customer view page

    public function show()
    {
        // Static data array
        $customers = [
            [
                'id' => 1,
                'sl_no' => '01',
                'company_name' => 'SRL Cements',
                'created_at' => '2024-01-15'
            ],
            [
                'id' => 2,
                'sl_no' => '02',
                'company_name' => 'SRL Cements',
                'created_at' => '2024-01-16'
            ],
        ];

        // Pagination data
        $pagination = [
            'current_page' => 1,
            'per_page' => 12,
            'total' => 50,
            'from' => 1,
            'to' => 12,
            'last_page' => 5
        ];

        return view('seller.customer.show', compact('customers', 'pagination'));
    }

}
