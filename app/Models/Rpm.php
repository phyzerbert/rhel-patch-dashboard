<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rpm extends Model
{
    protected $guarded = [];

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
