<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['description','status'];

    public function user()
    {
      return $this->hasMany(User::class, 'id', 'departament_id');
    }
}
