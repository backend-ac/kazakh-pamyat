<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'item_order',
    ];

    // Если у вас есть связь с компонентами
    public function components()
    {
        // Убедитесь, что здесь указана правильная модель
        return $this->hasMany(Component::class, 'page_id');
    }
}
