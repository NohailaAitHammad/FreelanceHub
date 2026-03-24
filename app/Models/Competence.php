<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $fillable = ['nom', 'deleted_at'];

    public function freelance()
    {
        return $this->belongsToMany(Freelance::class,
        "freelance_competence", "competence_id", "freelance_id");
    }

}
