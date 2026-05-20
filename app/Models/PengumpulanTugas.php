<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengumpulanTugas extends Model
{
    use HasFactory;

    protected $table = 'pengumpulan_tugas';

    protected $fillable = [
        'tugas_id',
        'user_id',
        'file_jawaban',
        'waktu_kumpul',
        'nilai',
        'catatan_nilai',
    ];

    protected $casts = [
        'waktu_kumpul' => 'datetime',
        'nilai' => 'integer',
    ];

    /**
     * Get the task associated with this submission.
     */
    public function tugas()
    {
        return $this->belongsTo(Tugas::class, 'tugas_id');
    }

    /**
     * Get the user (intern) who submitted the task.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
