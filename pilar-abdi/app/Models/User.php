<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    // Nama tabel
    protected $table = 'users';

    // Primary key
    protected $primaryKey = 'id_user';

    // Auto increment
    public $incrementing = true;

    // Kolom yang boleh diisi
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'whatsapp',
        'package',
        'sekdin',
        'address',
        'role',
    ];

    // Kolom yang disembunyikan
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Cast bawaan Laravel
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    // Relasi ke tabel pembayaran
    public function payments()
{
    return $this->hasMany(Payment::class, 'id_user', 'id_user');
}
}