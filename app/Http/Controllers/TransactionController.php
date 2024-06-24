<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        $products = Product::all();
        return view('transactions.index', compact('transactions', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric',
        ]);

        Transaction::create([
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'timestamp' => now(), // Automatically set the current timestamp
            'status' => 1, // default to success status
        ]);

        return redirect()->back()->with('success', 'Transaction added successfully.');
    }


    public function create()
    {
        $products = Product::all();
        return view('transactions.create', compact('products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'order_id' => 'required|string|max:255',
            'amount' => 'required|numeric',
            'status' => 'required|integer|in:1,2',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'status' => $request->status,
            'timestamp' => now(), // Automatically update the timestamp
        ]);

        return redirect()->back()->with('success', 'Transaction updated successfully.');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->back()->with('success', 'Transaction deleted successfully.');
    }
}
