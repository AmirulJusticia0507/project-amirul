<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index()
    {
        // Assuming $recentTransactions and $productInventory are defined here
        $recentTransactions = Transaction::orderByDesc('created_at')->take(5)->get();
        $productInventory = Product::all();

        return view('dashboard.index', compact('recentTransactions', 'productInventory'));
    }

}
