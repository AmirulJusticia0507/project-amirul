<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\TransactionLog;

class WalletController extends Controller
{
    // Fungsi untuk menampilkan halaman deposit & withdrawal
    public function depositWithdrawal()
    {
        $user = auth()->user(); // Mendapatkan user yang sedang terautentikasi

        // Ambil log transaksi untuk user tertentu
        $transactionLogs = TransactionLog::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('wallet.deposit_withdrawal', compact('user', 'transactionLogs'));
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

        // Log untuk deposit
        Log::channel('deposit_withdrawal')->info('User ' . $user->name . ' melakukan deposit sebesar ' . $request->amount . ' pada ' . now()->format('Y-m-d H:i:s'));

        // Simpan log transaksi ke database
        TransactionLog::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'type' => 'deposit',
        ]);

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

        // Log untuk withdrawal
        Log::channel('deposit_withdrawal')->info('User ' . $user->name . ' melakukan penarikan sebesar ' . $request->amount . ' pada ' . now()->format('Y-m-d H:i:s'));

        // Simpan log transaksi ke database
        TransactionLog::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'type' => 'withdrawal',
        ]);

        return redirect()->back()->with('success', 'Withdrawal successfully processed.');
    }
}
