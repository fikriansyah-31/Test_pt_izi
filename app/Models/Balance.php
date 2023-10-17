<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $table = 'balance';

    protected $primaryKey = 'id';

    protected $fillable = [
        'user_id', 'amount_available', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getBalanceByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
}
