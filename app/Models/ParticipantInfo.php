<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'participant_id',
        'image',
        'image_description',
        'text',
        'order',
    ];

    public function participant()
    {
        return $this->belongsTo(Participant::class);
    }
}
