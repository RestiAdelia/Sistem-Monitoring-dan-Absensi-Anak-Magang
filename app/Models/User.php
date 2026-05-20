<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'email', 'password', 'role', 'nomor_induk', 'instansi', 'mentor_id', 'is_active'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

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

    /**
     * Get the mentor who guides this user (intern).
     */
    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    /**
     * Get the interns guided by this user (mentor).
     */
    public function interns()
    {
        return $this->hasMany(User::class, 'mentor_id');
    }

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
