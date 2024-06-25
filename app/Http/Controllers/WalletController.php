<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class WalletController extends Controller
{
    // Fungsi untuk menampilkan halaman deposit & withdrawal
    public function depositWithdrawal()
    {
        $user = auth()->user(); // Mendapatkan user yang sedang terautentikasi
        return view('wallet.deposit_withdrawal', compact('user'));
    }

    // Fungsi untuk melakukan deposit
    public function deposit(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = auth()->user(); // Mendapatkan user yang sedang terautentikasi
        $user->wallet += $request->amount;
        $user->save();

        return redirect()->back()->with('success', 'Deposit successfully added.');
    }

    public function update(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        $user = auth()->user(); // Mendapatkan user yang sedang terautentikasi

        // Jika ingin menentukan jenis transaksi berdasarkan request
        if ($request->has('deposit')) {
            $user->wallet += $request->amount;
            $message = 'Deposit successfully added.';
        } elseif ($request->has('withdrawal')) {
            // Pastikan untuk menambahkan validasi agar withdrawal tidak melebihi saldo wallet
            if ($request->amount > $user->wallet) {
                return redirect()->back()->with('error', 'Insufficient wallet balance for withdrawal.');
            }
            $user->wallet -= $request->amount;
            $message = 'Withdrawal successfully processed.';
        } else {
            // Handle case when neither deposit nor withdrawal is specified
            return redirect()->back()->with('error', 'Invalid transaction type.');
        }

        $user->save();

        return redirect()->back()->with('success', $message);
    }

    // Fungsi untuk melakukan withdrawal
    public function withdrawal(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1|max:' . auth()->user()->wallet,
        ]);

        $user = auth()->user(); // Mendapatkan user yang sedang terautentikasi
        $user->wallet -= $request->amount;
        $user->save();

        return redirect()->back()->with('success', 'Withdrawal successfully processed.');
    }
}
