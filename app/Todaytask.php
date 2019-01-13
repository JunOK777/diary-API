<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todaytask extends Model
{
    protected $fillable = [
        'task-name', 'task-body', 'like-count'
    ];
}
