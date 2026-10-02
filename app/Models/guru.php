<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    //
    protected $table = 'gurus';

    protected $fillable = [
        'nama_guru',
        'nip',
        'mata_pelajaran',
        'foto',
    ];
}
