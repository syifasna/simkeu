<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pemasukan extends Model
{
    protected $table = 'pemasukans';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
