<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class galeri extends Model
{
    protected $table = 'galeris';

    protected $fillable = [
        'judul',
        'keterangan',
        'foto',
        'video',
        'kategori',
        'status',
        'tanggal',
    ];
}