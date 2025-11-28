<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'user_id';
    
    protected $fillable = [
        'username', 'password', 'nama_lengkap', 'level', 'can_verify', 'is_active', 'last_login'
    ];

    protected $hidden = ['password'];
    
    protected $casts = [
        'can_verify' => 'boolean',
        'is_active' => 'boolean',
        'last_login' => 'datetime',
        'password' => 'hashed',
    ];

    public function getAuthIdentifierName()
    {
        return 'username';
    }
}
