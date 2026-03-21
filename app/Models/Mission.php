<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = ['title', 'description', 'budget', 'category', 'duration', 'status', 'client', 'deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function client()
    {
        return $this->belongsTo(Category::class);
    }

    protected function casts()
    {
        return [
            'duration' => 'int',
            'budget' => 'float'
        ];
    }
}
