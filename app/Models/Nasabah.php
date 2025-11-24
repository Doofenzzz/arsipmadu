<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_nasabah',
        'nama_lengkap',
        'nik',
        'alamat',
        'telepon',
        'email',
        'tanggal_lahir',
        'jenis_kelamin',
        'pekerjaan',
        'penghasilan',
        'user_id',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'penghasilan' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kredits()
    {
        return $this->hasMany(Kredit::class);
    }

    public function dokumens()
    {
        return $this->hasMany(DokumenNasabah::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($nasabah) {
            if (empty($nasabah->no_nasabah)) {
                $nasabah->no_nasabah = 'NSB' . date('Ymd') . str_pad(static::max('id') + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}