<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutQuestion extends Model
{
    use HasFactory;

    protected $table = 'tryout_questions';

    protected $fillable = [
        'tryout_id',
        'nomor_soal',
        'kategori',
        'pertanyaan',
        'pilihan_a',
        'pilihan_b',
        'pilihan_c',
        'pilihan_d',
        'pilihan_e',
        'jawaban_benar',
        'pembahasan',
    ];

    public function tryout()
    {
        return $this->belongsTo(Tryout::class, 'tryout_id');
    }
}
