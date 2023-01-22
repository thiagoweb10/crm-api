<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Demand extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_id',
        'priority_id',
        'system_id',
        'created_by',
        'developer_id',
        'title',
        'description',
        'comment',
        'date_estimated',
        'date_expected',
        'file_document',
        'status_id',
    ];

    public function priority()
    {
        return $this->belongsTo(Priority::class, 'priority_id', 'id');
    }

    public function request()
    {
        return $this->belongsTo(Request::class, 'request_id', 'id');
    }

    public function sistem()
    {
        return $this->belongsTo(System::class, 'system_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(DemandStatus::class, 'status_id', 'id');
    }

    public function log()
    {
        return $this->hasMany(DemandLog::class, 'demand_id', 'id');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by','id');
    }

    public function developer()
    {
        return $this->belongsTo(User::class, 'developer_id','id');
    }
}