<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class AboutUs extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable=['heading','content','image','experience','happy_customer','team_advisor','return_customer'];
}
