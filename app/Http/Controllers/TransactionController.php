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
            'amount' => 'required|numeric|min:1', // Minimal amount harus lebih dari 0
            'status' => 'required|integer|in:1,2',
        ]);

        $user = Auth::user(); // Pastikan user terautentikasi
        $amount = $request->amount;
        $product = Product::findOrFail($request->product_id);
        $totalAmount = $product->price * $amount;

        if ($totalAmount > $user->wallet) {
            return redirect()->back()->withErrors(['amount' => 'Insufficient wallet balance.']);
        }

        // Kurangi saldo dari wallet pengguna hanya jika transaksi berhasil
        if ($request->status == 1) {
            $user->wallet -= $totalAmount;
            $user->save();
        }

        Transaction::create([
            'product_id' => $request->product_id,
            'amount' => $amount,
            'total_amount' => $totalAmount,
            'timestamp' => now(),
            'status' => $request->status,
        ]);

        // Update wallet balance after transaction
        $walletBalance = $user->wallet;

        return redirect()->back()->with('success', 'Transaction added successfully.')
                                 ->with(compact('walletBalance'));
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
