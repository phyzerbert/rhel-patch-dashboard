<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $guarded = [];

    public function site() {
        return $this->belongsTo(Site::class);
    }

    public function servers() {
        return $this->hasMany(Server::class);
    }
}
