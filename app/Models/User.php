<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_id',
        'hak_akses',
        'active_status'
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
        ];
    }

    public static function updateActiveStatus($userId, $status)
    {
        return DB::table('users')
            ->where('id', $userId)
            ->update(['active_status' => $status]);
    }

    public function pasien()
    {
        return $this->hasMany(Pasien::class, 'user_id');
    }

    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'user_id', 'kode_dokter');
    }

    public function orderChat()
    {
        return $this->hasOne(OrderChat::class, 'user_id');
    }

    public function janji()
    {
        return $this->hasOne(Janji::class, 'user_id');
    }
}
