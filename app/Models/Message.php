<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['content', 'read_at', 'sender', 'receiver', 'mission', 'deleted_at'];

    public function sender()
    {
        return $this->belongsTo(User::class);
    }

    public function receiver()
    {
        return $this->belongsTo(User::class);
    }
    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }
}
