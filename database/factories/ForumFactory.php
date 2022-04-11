<?php

namespace Database\Factories;

use App\Models\Auth\Role;
use App\Models\Category;
use App\Models\Forum;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ForumFactory extends Factory
{
    protected $model = Forum::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = Category::where(['categorizable_type' => Forum::class])->inRandomOrder()->first();
        $subCategory = Category::where(['parent_category_id' => $category->id])->inRandomOrder()->first();

        return [
            'title' => $this->faker->sentence(5),
            'description' => Str::substr($this->faker->paragraph,0,255),
            'image' => $this->faker->imageUrl(),
            'tags' => $this->faker->words(4),
            'writer_id' => User::where(['role_id' => Role::ROLE_CUSTOMER])->inRandomOrder()->first()->id,
            'category_id' => $category->id,
            'sub_category_id' => $subCategory ? $subCategory->id : null,
            'status' => $this->faker->randomElement([Forum::STATUS_PENDING,Forum::STATUS_REJECTED,Forum::STATUS_PUBLISHED]),
            'manager_id' => User::where('role_id',Role::ROLE_FORUM_MANAGER)->inRandomOrder()->first()
        ];
    }
}
