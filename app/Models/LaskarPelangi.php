<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaskarPelangi extends Model
{
    use HasFactory;

    protected $fillable = ['nama','user_id','kode','nik','jenis_pekerjaan','unit_kerja','penilaian'];

    public function Nilai(){
        return $this->hasMany(Nilai::class);
    }
}
