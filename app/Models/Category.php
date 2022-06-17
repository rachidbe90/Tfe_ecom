<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 */
class Category extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable=['title','slug','summary','photo','is_parent','parent_id','status'];


    /**
     * @param $cat_id
     * @return mixed
     */
    public static function shiftChild($cat_id){
        return Category::whereIn('id',$cat_id)->update(['is_parent'=>1]);
    }

    /**
     * @param $id
     * @return mixed
     */
    public static function getChildByParentID($id){
        return Category::where('parent_id',$id)->pluck('title','id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products(){
        return $this->hasMany('App\Models\Product','cat_id','id')->where('status','active');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function subcategories(){
        return $this->hasMany('App\Models\Category','parent_id','id')->where('status','active');
    }
}


