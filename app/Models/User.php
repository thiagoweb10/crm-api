<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable 
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'department_id',
        'profile_photo_path',
        'phone',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function departament()
    {
      return $this->hasMany(Department::class, 'department_id','id');
    }

    public function createdBydemandLog()
    {
        return $this->hasMany(DemandLog::class,'created_by','id');
    }

    public function createdBy()
    {
        return $this->hasMany(Demand::class, 'created_by','id');
    }

    public function developer()
    {
        return $this->hasMany(Demand::class, 'developer_id','id');
    }

    public function exports()
    {
        return $this->hasMany(Export::class, 'user_id','id');
    }

    public function setPasswordAttribute($value)
    {
        if (!is_null($value)) {
            $this->attributes['password'] = bcrypt($value);
        }
    }
}