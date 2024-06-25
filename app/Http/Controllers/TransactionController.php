<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth; // Ensure this is imported

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();
        $products = Product::all();
        $user = Auth::user(); // Get the authenticated user
        $walletBalance = $user->wallet; // Get the user's wallet balance

        return view('transactions.index', compact('transactions', 'products', 'walletBalance'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:1',
            'status' => 'required|in:1,2',
        ]);

        $product = Product::findOrFail($request->product_id);

        // Check if sufficient quantity is available
        if ($product->quantity < $request->amount) {
            return redirect()->back()->with('error', 'Insufficient stock.');
        }

        // Calculate total amount
        $totalAmount = $product->price * $request->amount;

        // Check if transaction amount exceeds wallet balance
        $user = Auth::user();
        if ($totalAmount > $user->wallet) {
            return redirect()->back()->with('error', 'Insufficient wallet balance.');
        }

        // Create transaction
        $transaction = Transaction::create([
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'status' => $request->status,
            'total_amount' => $totalAmount, // Store total amount in the transaction
        ]);

        // Deduct quantity from product stock
        $product->decrement('quantity', $request->amount);

        // Deduct total amount from user's wallet
        $user->wallet -= $totalAmount;
        $user->save();

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
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric',
            'status' => 'required|integer|in:1,2',
        ]);

        $transaction = Transaction::findOrFail($id);
        $transaction->update([
            'product_id' => $request->product_id,
            'amount' => $request->amount,
            'timestamp' => now(), // Automatically update the timestamp
            'status' => $request->status, // Update the status
        ]);

        return redirect()->back()->with('success', 'Transaction updated successfully.');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $user = Auth::user();

        // Check if the transaction was successful
        if ($transaction->status == 1) {
            // Restore wallet balance
            $user->wallet += $transaction->total_amount; // Restore the total amount deducted
            $user->save();
        }

        $transaction->delete();

        return redirect()->back()->with('success', 'Transaction deleted successfully.');
    }

}
