<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NilaiAkhirDanSertifikat extends Model
{
    use HasFactory;

    protected $table = 'nilai_akhir_dan_sertifikats';

    protected $fillable = [
        'user_id',
        'nilai_absensi',
        'nilai_tugas',
        'nilai_performa',
        'nilai_akhir',
        'file_sertifikat',
    ];

    protected $casts = [
        'nilai_absensi' => 'integer',
        'nilai_tugas' => 'integer',
        'nilai_performa' => 'integer',
        'nilai_akhir' => 'integer',
    ];

    /**
     * Get the user who owns this final grade and certificate.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
