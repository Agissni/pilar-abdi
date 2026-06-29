<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';

    protected $fillable = [
    'id_user',
        'bank',
        'account_number',
        'sender_name',
        'transfer_date',
        'transfer_time',
        'amount',
        'note',
        'proof_path',
        'status',
    ];

   public function user()
{
    return $this->belongsTo(User::class, 'id_user', 'id_user');
}
}