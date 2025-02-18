<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    /**
     * Поля, доступные для массового заполнения.
     *
     * @var array
     */
    protected $fillable = [
        'phone_1',
        'phone_2',
        'email',
    ];
}
