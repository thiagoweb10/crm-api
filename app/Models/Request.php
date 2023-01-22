<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = ['description','status'];

    public function demand()
    {
        return $this->hasMany(Demand::class, 'demand_id','id');
    }
}
