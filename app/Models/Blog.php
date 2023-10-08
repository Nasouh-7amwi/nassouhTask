<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Blog extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = true;

    protected $fillable = [
        'title',
        'content',
        'status',
        'subscriber_id',
    ];

    protected $hidden = [
        'updated_at'
    ];

    public function img()
    {
        return $this->morphOne(Image::class, 'imgable', 'imgable_type', 'imgable_id');
    }

    public function subscriber(){
        return $this->belongsTo(Subscriber::class,'subscriber_id');
    }
}
