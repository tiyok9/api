<?php

namespace App\Models;

use App\Models\HashId\HashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory,HashId;
    protected $table = 'karyawan';
    protected $guarded = ["id"];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan','id');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_karyawan','id');
    }
    public function user()
    {
        return $this->hasMany(User::class, 'id_karyawan','id');
    }
}
