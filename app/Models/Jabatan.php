<?php

namespace App\Models;

use App\Models\HashId\HashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory,HashId;
    protected $table = 'jabatan';
    protected $guarded = ["id"];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    public function departemen()
    {
        return $this->belongsTo(Departemen::class, 'id_departemen','id');
    }

    public function karyawan()
    {
        return $this->hasMany(Karyawan::class, 'id_jabatan','id');
    }
}
