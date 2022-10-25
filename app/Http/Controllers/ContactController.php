<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contactInfo()
    {
        return view('frontend.contact.index');
    }
}
