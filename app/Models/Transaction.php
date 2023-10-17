<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transaction';
    protected $primaryKey = 'id'; // Sesuaikan dengan kolom primary key Anda jika berbeda
    // ...

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
