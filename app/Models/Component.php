<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Component extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'description',
        'img',
        'video',
        'page_id',
        'is_general', // Если используем поле is_general
    ];

    public function page()
    {
        return $this->belongsTo(Page::class, 'page_id');
    }
}
