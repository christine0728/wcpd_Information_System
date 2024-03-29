<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Authenticatable
{ 
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'team';

    protected $fillable = [
        'username',
        'password', 
    ];
}
