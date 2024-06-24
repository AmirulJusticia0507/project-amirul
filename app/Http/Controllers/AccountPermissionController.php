<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccountPermissionController extends Controller
{
    public function index()
    {
        return view('account-permission.index');
    }
}
