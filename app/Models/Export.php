<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Export extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id'
        ,'file_name'
        ,'status_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class,  'user_id','id');
    }
}
