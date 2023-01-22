<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class System extends Model
{
    use HasFactory;

    protected $fillable = ['description','status'];

    public function demand()
    {
        return $this->hasMany(Demand::class, 'system_id','id');
    }

    public function scopeActive($query)
    {
        return $query->where('status','active');
    }
}
