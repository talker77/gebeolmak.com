<?php

namespace Database\Factories;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Product\Urun;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'              => $title = $this->faker->sentence(1),
            'slug'               => Str::slug($title),
            'categorizable_type' => $this->faker->randomElement($this->categoryTypes()),
            'is_active'          => 1,
            'description' => $this->faker->text(255),
            'show_homepage' => array_random([true,false])
        ];
    }

    private function categoryTypes()
    {
        return [
//            Blog::class,
            Forum::class,
        ];
    }
}
