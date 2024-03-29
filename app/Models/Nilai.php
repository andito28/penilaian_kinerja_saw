<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = ['laskar_pelangi_id','kriteria_id','nilai'];

    public function LaskarPelangi(){
        return $this->belongsTo(LaskarPelangi::class);
    }

    public function Kriteria(){
        return $this->belongsTo(Kriteria::class);
    }
}
