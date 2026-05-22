<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'nomor_induk',
        'data_magang_id',
        'data_mentor_id',
        'mentor_id',
        'is_active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }

    // ──────────────────────────────────────────────
    // Relationships for INTERN (role = 'magang')
    // ──────────────────────────────────────────────

    /**
     * An intern user belongs to one DataAnakMagang record.
     */
    public function dataMagang()
    {
        return $this->belongsTo(DataAnakMagang::class, 'data_magang_id');
    }

    /**
     * A mentor user belongs to one DataMentor record.
     */
    public function dataMentor()
    {
        return $this->belongsTo(DataMentor::class, 'data_mentor_id');
    }

    // ──────────────────────────────────────────────
    // Relationships for MENTOR (role = 'mentor')
    // ──────────────────────────────────────────────

    /**
     * A mentor is the parent user of this intern account.
     */
    public function mentor()
    {
        return $this->belongsTo(self::class, 'mentor_id');
    }

    /**
     * A mentor has many intern records assigned to them in data_anak_magang.
     */
    public function assignedInterns()
    {
        return $this->hasMany(DataAnakMagang::class, 'mentor_id');
    }

    /**
     * A mentor has many intern user accounts assigned to them.
     */
    public function interns()
    {
        return $this->hasMany(self::class, 'mentor_id')->where('role', 'magang');
    }

    // ──────────────────────────────────────────────
    // Existing operational relationships
    // (absensis, logbooks, etc. still reference users.id)
    // ──────────────────────────────────────────────

    /**
     * Get the attendance records of the user.
     */
    public function absensis()
    {
        return $this->hasMany(Absensi::class);
    }

    /**
     * Get the logbooks of the user.
     */
    public function logbooks()
    {
        return $this->hasMany(Logbook::class);
    }

    /**
     * Get the tasks created by the user (mentor).
     */
    public function tugas()
    {
        return $this->hasMany(Tugas::class, 'mentor_id');
    }

    /**
     * Get the tasks submitted by the user (intern).
     */
    public function pengumpulanTugas()
    {
        return $this->hasMany(PengumpulanTugas::class);
    }

    /**
     * Get the final grade and certificate details of the user.
     */
    public function nilaiAkhirDanSertifikat()
    {
        return $this->hasOne(NilaiAkhirDanSertifikat::class);
    }
}
