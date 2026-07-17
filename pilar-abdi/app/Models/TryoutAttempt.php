<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TryoutAttempt extends Model
{
    use HasFactory;

    protected $table = 'tryout_attempts';
    protected $primaryKey = 'id_tryout_attempt';

    protected $fillable = [
        'id_user',
        'id_tryout',
        'score_twk',
        'score_tiu',
        'score_tkp',
        'score_total',
        'status',
        'answers',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    public function tryout()
    {
        return $this->belongsTo(Tryout::class, 'id_tryout', 'id_tryout');
    }
}
