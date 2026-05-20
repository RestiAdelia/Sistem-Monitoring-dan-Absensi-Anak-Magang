<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logbook extends Model
{
    use HasFactory;

    protected $table = 'logbooks';

    protected $fillable = [
        'user_id',
        'tanggal',
        'judul_aktivitas',
        'deskripsi',
        'foto_bukti',
        'status_approval',
        'catatan_mentor',
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    /**
     * Get the user who owns this logbook entry.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
