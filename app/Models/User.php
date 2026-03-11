<?php

namespace App\Models;

use App\Models\HashId\HashId;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\Bridge\Client;
use Laravel\Passport\Contracts\OAuthenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable implements OAuthenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable,HashId ,HasApiTokens;
    protected $guarded = ["id"];
    public $incrementing = false;
    protected $keyType = 'string';
    protected $primaryKey = 'id';

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan','id');
    }
    public function cutiApprove()
    {
        return $this->hasMany(User::class, 'approved_By','id');
    }
    public function findForPassport($username)
    {
        return $this->where('username', $username)->first();
    }

    public function receivesBroadcastNotificationsOn()
    {
        return new PrivateChannel('user.notification.' . $this->id);
    }
}
