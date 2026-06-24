<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    protected $table = 'pembayarans';

    protected $guarded = ['id'];

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
