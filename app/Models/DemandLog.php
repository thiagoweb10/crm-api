<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'demand_id',
        'user_id',
        'comment',
        'status',
    ];

    public function demand()
    {
        return $this->belongsTo(Demand::class, 'demand_id','id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
