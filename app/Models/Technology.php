<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = ['nom', 'deleted_at'];

    public function freelances()
    {
        return $this->belongsToMany(Freelance::class);
    }
}
