<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plugin extends Model
{
    protected $fillable = ['name', 'slug', 'type'];

    public function licenses()
    {
        return $this->hasMany(License::class);
    }
}
