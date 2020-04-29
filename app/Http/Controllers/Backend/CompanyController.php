<?php

namespace App\Http\Controllers\Backend;

use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;

class CompanyController extends Controller
{
    public function index()
    {
    	dd('company Logged In');
        return view('users.pages.dashboard');
    }

}
