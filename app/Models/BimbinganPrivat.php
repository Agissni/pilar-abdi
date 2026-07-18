<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbinganPrivat extends Model
{
    use HasFactory;

    protected $table = 'bimbingan_privat';
    protected $primaryKey = 'id_bimbingan_privat';

    protected $fillable = [
        'id_user',
        'id_guru',
        'tgl_konsultasi',
        'jam_konsultasi',
        'topik',
        'status',
    ];

    protected $casts = [
        'tgl_konsultasi' => 'date',
    ];

    /**
     * Relasi ke Siswa (User)
     */
    public function siswa()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relasi ke Guru
     */
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }
}
