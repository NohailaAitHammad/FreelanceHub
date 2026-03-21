<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidature extends Model
{
    protected $fillable = ['motivation_letter', 'proposed_rate', 'status', 'mission', 'freelance'];

    public function freelance()
    {
        return $this->belongsTo(Freelance::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    protected function casts(): array
    {
        return [
            'proposed_rate' => 'float',
        ];
    }
}
