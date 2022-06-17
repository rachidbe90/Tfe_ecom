<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Order extends Model
{
    use HasFactory;

    /**
     * @var array
     */
    protected $guarded=[];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function products(){
        return $this->belongsToMany(Product::class,'product_orders')->withPivot('quantity','size','price');
    }
}
