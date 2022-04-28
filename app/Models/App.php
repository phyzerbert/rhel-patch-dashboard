<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class App extends Model
{
    protected $guarded = [];

    public $timestamps = false;

    public function site() {
        return $this->belongsTo(Site::class);
    }

    public function servers() {
        return $this->hasMany(Server::class);
    }
}
