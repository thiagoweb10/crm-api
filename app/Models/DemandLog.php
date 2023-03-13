<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemandLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'demand_id',
        'created_by',
        'developer_id',
        'status_id',
        'comment',
    ];

    public function demand()
    {
        return $this->belongsTo(Demand::class, 'demand_id','id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function developedBy()
    {
        return $this->belongsTo(User::class, 'developer_id','id');
    }

    public function status()
    {
        return $this->belongsTo(DemandStatus::class, 'status_id','id');
    }
}
