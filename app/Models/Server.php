<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $guarded = [];

    public function timelines() {
        return $this->hasMany(Timeline::class);
    }

    public function application() {
        return $this->hasOne(Application::class);
    }

    public function app() {
        return $this->belongsTo(App::class);
    }
}
