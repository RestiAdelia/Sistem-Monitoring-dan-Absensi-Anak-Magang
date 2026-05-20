<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis';

    protected $fillable = [
        'user_id',
        'tanggal',
        'jam_masuk',
        'jam_pulang',
        'latitude_masuk',
        'longitude_masuk',
        'status_kehadiran',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jam_masuk' => 'datetime:H:i:s',
        'jam_pulang' => 'datetime:H:i:s',
        'latitude_masuk' => 'double',
        'longitude_masuk' => 'double',
    ];

    /**
     * Get the user who owns this attendance record.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
