<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Subscriber extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    protected $table = 'subscribers';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'userName',
        'password',
        'status',
        'subscribed',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function setLoggedInStatus($value)
    {
        $this->attributes['status'] = true;
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'subscriber_id');
    }

}
