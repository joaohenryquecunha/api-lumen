<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Redirect extends Model
{
    protected $table = 'redirect';
    protected $fillable = [
        'url',
        'current_click',
        'max_click',
        'link_id'
    ];
    
}
