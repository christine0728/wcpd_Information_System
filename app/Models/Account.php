<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Account extends Authenticatable
{ 
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'account';

    protected $fillable = [
        'firstname',
        'lastname',
        'username',
        'password', 
        'acc_type',
        'team',
        'status',
        'change_password_req',
        'last_change_password'
    ];
}
