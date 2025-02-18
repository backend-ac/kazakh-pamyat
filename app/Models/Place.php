<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;

    protected $table = 'places';

    protected $fillable = [
        'place_image',
        'title',
        'text',
        'banner',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'order',
    ];

    public function participants()
    {
        return $this->hasMany(\App\Models\Participant::class);
    }
}
