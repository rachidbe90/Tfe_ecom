<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 *
 */
class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=>$this->faker->word,
            'slug'=>$this->faker->unique()->slug,
            'summary'=>$this->faker->text,
            'description'=>$this->faker->paragraphs(3,true),
            'additional_info'=>$this->faker->paragraphs(3,true),
            'cat_id'=>$this->faker->randomElement(Category::where('is_parent',1)->pluck('id')->toArray()),
            'child_cat_id'=>$this->faker->randomElement(Category::where('is_parent',0)->pluck('id')->toArray()),
            'photo'=>$this->faker->imageUrl('255','274'),
            'price'=>$this->faker->numberBetween(400,500),
            'offer_price'=>$this->faker->numberBetween(100,350),
            'discount'=>$this->faker->numberBetween(0,100),
            'conditions'=>$this->faker->randomElement(['new','popular','winter']),
            'added_by'=>'admin',
            'is_featured'=>0,
            'status'=>$this->faker->randomElement(['active','inactive']),
            'created_at'=>Carbon::now(),
            'updated_at'=>Carbon::now(),
        ];
    }
}
