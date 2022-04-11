<?php

namespace Database\Factories;

use App\Models\Auth\Role;
use App\Models\Category;
use App\Models\Forum;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    protected $model = User::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::substr($this->faker->name,0,25),
            'surname' => $this->faker->sentence(1),
            'email' => $this->faker->email,
            'password' => Hash::make(config('admin.password')),
            'is_active' => $this->faker->randomElement([false,true]),
            'about' => $this->faker->text,
            'role_id' => $this->faker->randomElement([Role::ROLE_CUSTOMER,Role::ROLE_MANAGER,Role::ROLE_FORUM_MANAGER]),
        ];
    }
}
