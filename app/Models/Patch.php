<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patch extends Model
{
    protected $guarded = [];

    public function site() {
        return $this->belongsTo(Site::class);
    }

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
