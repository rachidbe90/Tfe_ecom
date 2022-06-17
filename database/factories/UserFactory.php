<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 *
 */
class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->name,
            'last_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'username'=>$this->faker->unique()->userName,
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password 1111 default
            'phone'=>$this->faker->phoneNumber,
            'country'=>$this->faker->country,
            'city'=>$this->faker->city,
            'street'=>$this->faker->streetName,
            'postcode'=>$this->faker->numerify('####'),
            'num'=>$this->faker->numerify('####'),
            'photo'=>$this->faker->imageUrl('60','60'),
            'status'=>$this->faker->randomElement(['active','inactive']),
            'remember_token' => Str::random(10),
            'role'=>$this->faker->randomElement(['customer','vendor']),
        ];
    }
}
