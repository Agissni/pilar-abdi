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

    // Relasi ke tabel pengumuman
    public function announcements()
    {
        return $this->hasMany(Pengumuman::class, 'id_user', 'id_user');
    }

    // Relasi ke bimbingan privat
    public function bimbinganPrivat()
    {
        return $this->hasMany(BimbinganPrivat::class, 'id_user', 'id_user');
    }

    // Relasi ke kelas (Many-to-Many via kelas_siswa)
    public function kelas()
    {
        return $this->belongsToMany(Kelas::class, 'kelas_siswa', 'id_user', 'id_kelas', 'id_user', 'id_kelas');
    }
}