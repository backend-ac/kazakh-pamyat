<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    use HasFactory;

    protected $table = 'abouts';

    protected $fillable = [
        'project_manager_name',
        'project_manager_text',
        'project_manager_photo',
        'project_goal_title',
        'project_goal_text',
        'project_goal_photo',
    ];
}
