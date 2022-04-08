<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatchInstallDate extends Model
{
    protected $guarded = [];

    public function server() {
        return $this->belongsTo(Server::class);
    }
}
