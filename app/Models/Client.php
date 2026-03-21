<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = ['company', 'description', 'user_id', 'deleted_at'];
    public function user()
    {
        $this->belongsTo(User::class);
    }

}
