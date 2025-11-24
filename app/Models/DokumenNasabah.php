<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DokumenNasabah extends Model
{
    use HasFactory;

    protected $fillable = [
        'nasabah_id',
        'jenis_dokumen',
        'nama_file',
        'file_path',
        'keterangan',
        'tanggal_upload',
        'user_id',
    ];

    protected $casts = [
        'tanggal_upload' => 'date',
    ];

    // Relasi ke Nasabah
    public function nasabah()
    {
        return $this->belongsTo(Nasabah::class, 'nasabah_id', 'id');
    }

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}