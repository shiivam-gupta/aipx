<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    public function index()
    {
    	dd('Customer Logged In');
        return view('users.pages.dashboard');
    }

}
