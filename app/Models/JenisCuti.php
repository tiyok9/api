<?php

namespace App\Models;

use App\Models\HashId\HashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisCuti extends Model
{
    use HasFactory,HashId;
    protected $table = 'jenis_cuti';
    protected $guarded = ["id"];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    public function cuti()
    {
        return $this->hasMany(Cuti::class, 'id_jenis_cuti','id');
    }
}
