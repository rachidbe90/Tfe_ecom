<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Coupon extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable=[
        'code',
        'value',
        'status',
        'type',
    ];

    /**
     * @param $total
     * @return float|int
     */
    public function discount($total){
       if ($this->type=="percent") {
           return($this->value/100)*$total;
       }
       else{
           return 0;
       }
    }
}
