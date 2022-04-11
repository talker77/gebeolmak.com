<?php

namespace Database\Factories;

use App\Models\Auth\Role;
use App\Models\Forum;
use App\Models\ForumComment;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ForumCommentFactory extends Factory
{

    protected $model = ForumComment::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $forum = Forum::inRandomOrder()->first();
        $comment = ForumComment::where(['forum_id' => $forum->id])->inRandomOrder()->first();

        return [
            'forum_id' => $forum->id,
            'user_id' => User::where(['role_id' => Role::ROLE_CUSTOMER])->inRandomOrder()->first()->id,
            'comment' => $this->faker->sentence(10),
            'status' => $this->faker->randomElement([ForumComment::STATUS_REJECTED, ForumComment::STATUS_PUBLISHED, ForumComment::STATUS_PENDING]),
            'replied_id' => random_int(0, 20) % 3 == 0 ? ($comment ? $comment->id : null) : null
        ];
    }
}
