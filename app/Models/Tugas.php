<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    protected $table = 'tugas';

    protected $fillable = [
        'mentor_id',
        'judul_tugas',
        'deskripsi_tugas',
        'file_materi',
        'deadline',
    ];

    protected $casts = [
        'deadline' => 'datetime',
    ];

    /**
     * Get the mentor who dispatched the task.
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    /**
     * Get the submissions for this task.
     */
    public function pengumpulanTugas()
    {
        return $this->hasMany(PengumpulanTugas::class, 'tugas_id');
    }
}
