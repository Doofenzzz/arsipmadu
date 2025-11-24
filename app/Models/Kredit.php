<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kredit extends Model
{
    use HasFactory;

    protected $fillable = [
        'no_pengajuan',
        'nasabah_id',
        'jenis_kredit',
        'jumlah_pengajuan',
        'jangka_waktu',
        'bunga',
        'tujuan_pengajuan',
        'status',
        'catatan',
        'tanggal_pengajuan',
        'user_id',
    ];

    protected $casts = [
        'tanggal_pengajuan' => 'date',
        'jumlah_pengajuan' => 'decimal:2',
        'bunga' => 'decimal:2',
    ];

    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($kredit) {
            if (empty($kredit->no_pengajuan)) {
                $kredit->no_pengajuan = 'KRD' . date('Ymd') . str_pad(static::max('id') + 1, 4, '0', STR_PAD_LEFT);
            }
        });
    }
}