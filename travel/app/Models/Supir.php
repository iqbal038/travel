<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Supir extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];
    protected $table = 'supir';
    protected $fillable = [
        'nama_supir', 'ttl_supir', 'no_telpon', 'jenis_kendaraan','norek','ontrip', 'id_user'
    ];

    public function routeNotifcationForNexmo($notification)
    {
        return $this->no_telpon;
    }
}
