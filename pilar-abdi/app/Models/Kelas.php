<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';

    protected $fillable = [
        'nama_kelas',
        'materi',
        'guru_id',
        'hari',
        'jam',
        'deskripsi',
        'gmeet_link',
        'materi_pdf_path',
        'materi_pdf_name',
    ];

    // Relasi ke guru
    public function guru()
    {
        return $this->belongsTo(Guru::class, 'guru_id');
    }
}
