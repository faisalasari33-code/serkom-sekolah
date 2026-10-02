<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class siswa extends Model
{
    //

    protected $table = 'siswas';

    protected $fillable = [
        'nisn',
        'nama_siswa',
        'jenis_kelamin',
        'tanggal_masuk',
    ];
}
