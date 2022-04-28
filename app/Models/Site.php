<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function servers() {
        return $this->hasMany(Server::class);
    }
}
