<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guru extends Model
{
    protected $table = 'gurus';

    protected $fillable = [
        'nip',
        'nama_guru',
        'mapel_id', // <-- WAJIB TAMBAHKAN INI!
        'foto',
    ];

    public function mapel()
    {
        return $this->belongsTo(Mapel::class, 'mapel_id', 'id');
    }
}