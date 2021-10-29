<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $primaryKey = 'id_barang';

    protected $keyType = 'integer';

    public $incrementing = false;

    protected $guarded = [];

    public function scopeFilter($query, array $filters){
        $query->when($filters['search'] ?? false, fn($query, $search)=>$query
            ->where('nama', 'like', '%'.$search.'%')
            ->orWhere('deskripsi', 'like', '%' . $search.'%'));
    }
}
