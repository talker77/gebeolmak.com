<?php

namespace Database\Factories;

use App\Models\Auth\Role;
use App\Models\Blog;
use App\Models\Category;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $category = Category::where(['categorizable_type' => Blog::class, 'parent_category_id' => null])->inRandomOrder()->first();
        $subCategory = Category::where('categorizable_type', Blog::class)->where('parent_category_id',$category->id)->inRandomOrder()->first();

        return [
            'title' => $title = $this->faker->sentence(3),
            'slug' => Str::slug($title),
            'description' => $this->faker->text(4000),
            'image' => "image1.jpg",
            'tags' => $this->faker->words(5),
            'is_active' => $this->faker->boolean,
            'lang' => 1,
            'category_id' => $category,
            'sub_category_id' => $subCategory ? $subCategory->id : null,
            'writer_id' => User::where(['role_id' => Role::ROLE_MANAGER])->inRandomOrder()->first(),
            'view_count' => $this->faker->randomNumber(),
            'type' => $this->faker->randomElement([array_search($this->faker->randomElement(array_merge(Blog::TYPES)),Blog::TYPES),null])
        ];
    }
}
