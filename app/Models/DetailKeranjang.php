<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKeranjang extends Model
{
    use HasFactory;
    protected $table = 'detail_keranjang';

    protected $primaryKey = 'id_detail_keranjang';

    protected $keyType = 'integer';

    public $incrementing = false;

    protected $fillable = [
        'id_keranjang',
        'id_barang',
        'harga',
        'jumlah',
        'total'
    ];
    protected $guarded = [];
}
