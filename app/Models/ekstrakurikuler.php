<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ekstrakurikuler extends Model
{
    protected $table = 'ekstrakulikulers'; 

    protected $fillable = [
        'nama_ekstrakulikuler',
        'pembina',
        'jadwal_latihan',
        'deskripsi',
        'foto',
    ];
}