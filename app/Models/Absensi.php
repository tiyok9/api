<?php

namespace App\Models;

use App\Models\HashId\HashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory,HashId;
    protected $table = 'absensi';
    protected $guarded = ["id"];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan','id');
    }
}
