<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['company', 'description', 'user_id', 'deleted_at', 'rating_average'];


    public function user()
    {
      return  $this->belongsTo(User::class);
    }


    protected function casts(): array
    {
        return [
            'rating_average' => "float"
        ];
    }

}
