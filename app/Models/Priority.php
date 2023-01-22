<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Priority extends Model
{
    use HasFactory;

    protected $fillable = ['description','status'];

    public function demand()
    {
      return $this->hasMany(Demand::class, 'id', 'demand_id');
    }

	public function scopeActive($query)
	{
		return $query->where('status', 'active');
	}
}
