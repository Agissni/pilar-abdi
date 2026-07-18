<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tryout extends Model
{
    use HasFactory;

    protected $table = 'tryouts';
    protected $primaryKey = 'id_tryout';

    protected $fillable = [
        'nama_tryout',
        'deskripsi',
        'jumlah_soal',
        'durasi',
        'tanggal_mulai',
        'tanggal_berakhir',
        'status',
    ];

    protected $casts = [
        'tanggal_mulai' => 'datetime',
        'tanggal_berakhir' => 'datetime',
    ];

    public function questions()
    {
        return $this->hasMany(TryoutQuestion::class, 'id_tryout', 'id_tryout');
    }
}
