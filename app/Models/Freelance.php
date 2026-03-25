<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Freelance extends Model
{

    protected $fillable = ['bio', 'experience', 'availability', 'user_id', 'deleted_at', 'rating_average', 'rating_count'];

    public function user()
    {
      return  $this->belongsTo(User::class);
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class,
        "freelance_competence", "freelance_id", "competence_id");
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class,
        "freelance_technologie", "freelance_id", "technology_id");
    }

    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'reviewed_id');
    }

    public function candidatures(): HasMany
    {
        return $this->hasMany(Candidature::class);
    }

    protected function casts()
    {
        return [
            'experience' => 'integer',
            'rating_average' => 'float',
            'rating_count' => 'int'
        ];
    }
}
