<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    use HasFactory;

    protected $table = 'pengumuman';
    protected $primaryKey = 'id_pengumuman';

    protected $fillable = [
        'id_user',
        'judul',
        'isi',
        'target_role',
        'tanggal_publikasi',
        'status',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
    ];

    /**
     * Relasi ke model User (Pembuat Pengumuman/Admin)
     */
    public function admin()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }
}
