<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $fillable = [
        'place_id',
        'name',
        'date_of_birth',
        'date_of_death',
        'where_did_participate',
        'photo',
        'bio'
        ,
        // новые поля:
        'sender_name',
        'user_message',
        'type',
        'show_on_gs'
    ];

    // Связь "Участник" принадлежит "Месту"
    public function place()
    {
        return $this->belongsTo(Place::class);
    }

    // Связь с таблицей ParticipantInfo (многие блоки дополнительной инфы)
    public function infos()
    {
        return $this->hasMany(ParticipantInfo::class);
    }
}
