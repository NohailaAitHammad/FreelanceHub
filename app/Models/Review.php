<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = ['rating', 'comment', 'reviewed_id', 'reviewer_id','deleted_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function freelance()
    {
        return $this->belongsTo(Freelance::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewer_id');
    }

    public function reviewed()
    {
        return $this->belongsTo(User::class, 'reviewed_id');
    }

    protected function casts()
    {
        return [
            'rating' => 'int'
        ];
    }
}
