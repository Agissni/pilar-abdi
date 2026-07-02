<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'gurus';

    protected $fillable = [
        'nama',
        'spesialisasi',
        'whatsapp',
        'email',
        'password',
        'bio',
    ];

    // Relasi ke kelas
    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'guru_id');
    }
}
