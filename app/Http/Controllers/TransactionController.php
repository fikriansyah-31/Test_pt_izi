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


        $trxId = $request->input('trx_id');
        $amount = $request->input('amount');

    
        sleep(30);

        return response()->json([
            'trx_id' => $trxId,
            'amount' => $amount,
        ], 201); 
    }

    public function getTransactionData(Request $request)
    {
        $users = User::all();
        
        $data = [];
        
        foreach ($users as $user) {
            $balance = Balance::where('user_id', $user->id)->first();
        
            
        
            $transactions = Transaction::where('user_id', $user->id)->get();
        
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
