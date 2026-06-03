<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataAnakMagang extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'data_anak_magang';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nim_nisn',
        'nama',
        'instansi',
        'tanggal_mulai_magang',
        'tanggal_selesai_magang',
        'mentor_id',
        'status_akun',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'tanggal_mulai_magang' => 'date',
            'tanggal_selesai_magang' => 'date',
        ];
    }

    // ──────────────────────────────────────────────
    // Relationships
    // ──────────────────────────────────────────────

    /**
     * The mentor (User with role=mentor) assigned to this intern data.
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    /**
     * The user account created from this intern data (if status_akun = 'Aktif').
     */
    public function userAccount()
    {
        return $this->hasOne(User::class, 'data_magang_id');
    }
}
