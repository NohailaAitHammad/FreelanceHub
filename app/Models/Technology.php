<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Technology extends Model
{
    protected $fillable = ['nom', 'deleted_at'];

    public function freelance()
    {
        return $this->belongsToMany(Freelance::class,
            "freelance_technologie", "technology_id", "freelance_id");

    }
}
