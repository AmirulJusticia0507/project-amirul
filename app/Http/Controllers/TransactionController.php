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
        return view('transactions.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric',
            'timestamp' => 'required|date',
        ]);

        Transaction::create([
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'timestamp' => $request->timestamp,
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
            'timestamp' => 'required|date',
            'status' => 'required|integer|in:1,2',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'order_id' => $request->order_id,
            'amount' => $request->amount,
            'timestamp' => $request->timestamp,
            'status' => $request->status,
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
