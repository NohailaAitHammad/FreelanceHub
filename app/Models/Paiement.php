<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paiement extends Model
{
    protected $fillable = ['amount', 'payment_method', 'client', 'freelance', 'mission', 'deleted_at'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function freelance()
    {
        return $this->belongsTo(Freelance::class);
    }

    public function mission()
    {
        return $this->belongsTo(Mission::class);
    }

    protected function casts()
    {
        return [
            'amount' => 'float'
        ];
    }
}
