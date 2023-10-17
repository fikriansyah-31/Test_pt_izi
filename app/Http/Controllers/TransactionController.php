<?php

namespace App\Http\Controllers;

use App\Models\Balance;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'trx_id' => 'required|string',
            'amount' => 'required|numeric',
        ]);

        // Lakukan logika Anda di sini, sesuai dengan pseudocode yang diberikan

        // Contoh: menyimpan data transaksi ke dalam database
        $trxId = $request->input('trx_id');
        $amount = $request->input('amount');

        // Simpan data transaksi ke dalam database
        // Misalnya, Anda memiliki model Transaction yang sesuai
        // Transaction::create(['trx_id' => $trxId, 'amount' => $amount]);
        sleep(30);

        // Berikan respons dengan data yang disimpan
        return response()->json([
            'trx_id' => $trxId,
            'amount' => $amount,
        ], 201); // 201 adalah kode respons Created
    }

    public function getTransactionData(Request $request)
    {
        // Get all users
        $users = User::all();
        
        // Initialize an array to store the data for each user
        $data = [];
        
        // Iterate through each user
        foreach ($users as $user) {
            // Get the user's balance
            $balance = Balance::where('user_id', $user->id)->first();
        
            
        
    // Get the user's transactions
            $transactions = Transaction::where('user_id', $user->id)->get();
        
            // Organize user and transaction data
            $userData = [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'balance' => $balance ? round($balance->amount_available, 6) : 0,
                'transaction' => $transactions->map(function ($transaction) {
                    return [
                        'trx_id' => $transaction->trx_id,
                        'amount' => round($transaction->amount, 6),
                    ];
                }),
            ];
        
            // Add user data to the array
            $data[] = $userData;
        }
        
        
       
    // Return a JSON response with the desired format
        return response()->json(['data' => $data]);
    }
    

}
