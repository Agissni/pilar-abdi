<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $primaryKey = 'id_kelas';

    protected $fillable = [
        'nama_kelas',
        'materi',
        'id_guru',
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
        return $this->belongsTo(Guru::class, 'id_guru', 'id_guru');
    }

    // Relasi ke siswa (Many-to-Many via kelas_siswa)
    public function siswa()
    {
        return $this->belongsToMany(User::class, 'kelas_siswa', 'id_kelas', 'id_user', 'id_kelas', 'id_user');
    }
}
