<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    // Nama tabel dalam basis data
    protected $table = 'balance';

    // Nama kolom yang digunakan sebagai primary key
    protected $primaryKey = 'id';

    // Daftar kolom yang dapat diisi (fillable)
    protected $fillable = [
        'user_id', 'amount_available', 'created_at', 'updated_at'
    ];

    // Relasi dengan model User (jika diperlukan)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Method untuk mengambil saldo berdasarkan user_id
    public function getBalanceByUserId($userId)
    {
        return $this->where('user_id', $userId)->first();
    }
}
