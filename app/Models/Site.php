<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function apps() {
        return $this->hasMany(App::class);
    }
}
