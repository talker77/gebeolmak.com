<?php

namespace Database\Seeders;


use App\Models\Blog;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Kategori;
use Faker\Generator;
use Faker\Provider\en_US\Text;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KategorilerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $kategorilerTableName = 'kategoriler';
//        DB::table($kategorilerTableName)->delete();
//        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
//        Category::truncate();
//        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = json_decode(file_get_contents(database_path('seeders/files/categories.json'), true), true);
        foreach ($categories as $category) {
            $parent = Category::updateOrCreate([
                'title' => $category['title'],
                'categorizable_type' => Blog::class
            ], [
                'slug' => Str::slug($category['title']),
                'is_active' => 1,
                'description' => (new Text(new Generator()))->realText(250),
                'show_homepage' => true
            ]);
            if (isset($category['children'])) {
                foreach ($category['children'] as $child) {
                    $parent->sub_categories()->updateOrCreate([
                        'title' => $child['title']
                    ], array_merge($child, [
                        'slug' => Str::slug("{$parent->title} {$child['title']}"),
                        'categorizable_type' => Blog::class,
                        'is_active' => 1,
                        'description' => (new Text(new Generator()))->realText(250),
                        'show_homepage' => true
                    ]));
                }
            }
        }

        // forum seeder

        $categories = json_decode(file_get_contents(database_path('seeders/files/forum_categories.json'), true), true);
        foreach ($categories as $category) {
            $parent = Category::updateOrCreate([
                'title' => $category['title'],
                'categorizable_type' => Forum::class
            ], [
                'slug' => Str::slug($category['title']),
                'is_active' => 1,
                'description' => (new Text(new Generator()))->realText(250)
            ]);
            if (isset($category['children'])) {
                foreach ($category['children'] as $child) {
                    $parent->sub_categories()->updateOrCreate([
                        'title' => $child['title']
                    ], array_merge($child, [
                        'slug' => Str::slug("{$parent->title} {$child['title']}"),
                        'categorizable_type' => Forum::class,
                        'is_active' => 1,
                        'description' => (new Text(new Generator()))->realText(250)
                    ]));
                }
            }
        }
    }
}
