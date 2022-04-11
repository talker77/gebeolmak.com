<?php

namespace Database\Seeders;

use App\Models\ForumComment;
use Illuminate\Database\Seeder;

class ForumCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ForumComment::factory(100)->create();
        ForumComment::factory(100)->create();
    }
}
