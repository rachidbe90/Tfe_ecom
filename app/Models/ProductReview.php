<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Ce model est cré pour une utilisation ultérieure, quand je mettrais en place les commentaires sur le produit
 */
class ProductReview extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable=['user_id','product_id','rate','review','reason','status'];
}
