<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    protected $table = 'link';
    protected $fillable = [
        'title_link',
        'redirect_url',
        'maximum_cliks'
    ];

    public function redirects()
    {
        return $this->hasMany(Redirect::class);
    }

    public function updateMaxClicks()
    {
        $sum = $this->redirects()->sum('max_click');
        $this->maximum_cliks = $sum;
        $this->save();
    }
}
