<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Maintask extends Model
{
    protected $fillable = [
        'task-name', 'task-body', 'like-count'
    ];
}
