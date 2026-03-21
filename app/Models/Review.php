<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['rating', 'comment', 'client', 'freelance','deleted_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function freelance()
    {
        return $this->belongsTo(Freelance::class);
    }

    protected function casts()
    {
        return [
            'rating' => 'int'
        ];
    }
}
