<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $timestamps = true;

    protected $fillable = [
        'imgable_id',
        'imgable_type',
        'path'
    ];

    public function imgable()
    {
        return $this->morphTo(__FUNCTION__, 'imgable_type', 'imgable_id');
    }

}
