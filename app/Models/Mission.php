<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    protected $fillable = ['title', 'description', 'budget', 'category_id', 'duration', 'status', 'user_id', 'deleted_at'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function candidatures()
    {
        return $this->hasMany(Candidature::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class);
    }



    protected function casts()
    {
        return [
            'duration' => 'int',
            'budget' => 'float'
        ];
    }
}
