<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';

    protected $primaryKey = 'id_keranjang';

    protected $keyType = 'integer';

    public $incrementing = false;

    protected $fillable = [
        'id_user',
        'status'
    ];
    protected $guarded = [];

}
