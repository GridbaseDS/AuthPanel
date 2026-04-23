<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable = ['plugin_id', 'domain', 'license_key', 'status', 'email', 'registered_at'];

    public function plugin()
    {
        return $this->belongsTo(Plugin::class);
    }
}
