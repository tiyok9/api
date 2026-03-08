<?php

namespace App\Models;

use App\Models\HashId\HashId;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departemen extends Model
{
    use HasFactory,HashId;
    protected $table = 'departemen';
    protected $guarded = ["id"];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    public function jabatan()
    {
        return $this->hasMany(Jabatan::class, 'id_departemen','id');
    }
}
