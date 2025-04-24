<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $fillable = [
        'id',
        'nama',
        'alamat',
        'telepon'
    ];

    public function dokumen(){
        return $this->hasMany(Dokumen::class, 'pelanggan_id');
    }
}
