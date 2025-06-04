<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Customer\ContactUsRequest;
use App\Models\Customer\ContactUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the contact messages.
     */

     public function contactUs()
     {
         return view('customer.contact.contact_us');
     }
    /**
     * Store a newly created contact message.
     */
    public function store(ContactUsRequest $request)
    {
        $data = $request->validated();

        // If user is logged in, attach their user_id
        if (Auth::check()) {
            $data['user_id'] = Auth::id();
        }

        ContactUs::create($data);

        return redirect()->back()
            ->with('message', 'Thank you for contacting us! We will get back to you soon.')
            ->with('alert-type', 'success');
    }

    /**
     * Display the specified contact message.
     */


    /**
     * Remove the specified contact message.
     */
}