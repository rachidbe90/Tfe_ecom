<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 *
 */
class Admin extends Authenticatable
{
    use HasFactory,Notifiable;

    /**
     * @var string
     */
    protected $guard='admins';
    /**
     * @var string[]
     */
    protected $fillable=['first_name', 'last_name','email','photo','password','status'];
}
