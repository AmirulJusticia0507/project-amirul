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
