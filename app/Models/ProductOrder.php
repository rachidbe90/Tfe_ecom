<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class ProductOrder extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable=['product_id','order_id','quantity','size'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function attribute(){
        return $this->hasOne(ProductAttribute::class);
    }
}
