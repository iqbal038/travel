<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $primaryKey = 'id';
    protected $table = 'pemesanan';

    protected $fillable = [
        'id','nama_pemesan', 'status', 'no_telp', 'no_pemesanan', 'tanggal_pemesanan', 'jumlah_pemesanan','id_tujuan', 'id_supir', 'id_user'
    ];
}
