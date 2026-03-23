<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Freelance extends Model
{
    protected $fillable = ['bio', 'experience', 'availability', 'user_id', 'deleted_at'];
    public function user()
    {
      return  $this->belongsTo(User::class);
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }

    protected function casts()
    {
        return [
            'experience' => 'integer'
        ];
    }
}
