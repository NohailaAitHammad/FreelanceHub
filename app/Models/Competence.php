<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Competence extends Model
{
    protected $fillable = ['nom', 'deleted_at'];

    public function user()
    {
        return $this->belongsToMany(User::class);
    }

}
