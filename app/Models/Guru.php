<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Guru extends Model
{
    use HasFactory;

    protected $table = 'guru';
    protected $primaryKey = 'id_guru';

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
        return $this->hasMany(Kelas::class, 'id_guru', 'id_guru');
    }

    // Relasi ke bimbingan privat
    public function bimbinganPrivat()
    {
        return $this->hasMany(BimbinganPrivat::class, 'id_guru', 'id_guru');
    }
}
