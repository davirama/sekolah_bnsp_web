<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nisn',
        'province_id',
        'city_id',
        'province_id_lahir',
        'city_id_lahir',
        'kecamatan',
        'agama_id',
        'nama_lengkap',
        'role',
        'email',
        'password',
        'phone_number',
        'telp_number',
        'address_ktp',
        'address_now',
        'kewarganegaraan',
        'nama_kewarganegaraan',
        'tgl_lahir',
        'tempat_lahir',
        'negara_lahir',
        'jenis_kelamin',
        'status_menikah',
        'status_daftar',
        'message_status_daftar',
        'foto',
        'video',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the province associated with the user.
     */
    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id');
    }

    /**
     * Get the city associated with the user.
     */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Get the province of birth associated with the user.
     */
    public function provinceOfBirth()
    {
        return $this->belongsTo(Province::class, 'province_id_lahir');
    }

    /**
     * Get the city of birth associated with the user.
     */
    public function cityOfBirth()
    {
        return $this->belongsTo(City::class, 'city_id_lahir');
    }

    /**
     * Get the religion associated with the user.
     */
    public function agama()
    {
        return $this->belongsTo(Agama::class, 'agama_id');
    }
}
