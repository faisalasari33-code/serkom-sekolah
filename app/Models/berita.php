<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use illuminate\Database\Eloquent\Concerns\HasUuids;


class berita extends Model
{
    //
    use HasUuids;
    
    protected $table = 'berita';
    protected $primaryKey = 'id_berita';
    protected $KeyType = 'string';
    public $incrementing = false;
    public $timestamps = false;

    protected $guarded = [];
}
