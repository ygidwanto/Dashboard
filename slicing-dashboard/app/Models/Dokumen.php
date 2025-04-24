<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumen extends Model
{
    protected $fillable = [
        'id',
        'pelanggan_id',
        'status',
        'dokumen',
        'nr',
        'tanggal',
        'realisasi',
        'tanggal_awal'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'realisasi' => 'date',
        'tanggal_awal' => 'date',
    ];

    public function pelanggan(){
        return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }
}
