<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Forum;
use App\Models\ForumComment;
use Illuminate\Http\Request;

class ForumCommentController extends Controller
{
    /**
     * @param Request $request
     * @param Forum $forum
     * @param ForumComment|null $replied
     * @return string
     */
    public function store(Request $request, Forum $forum, ?ForumComment $replied)
    {
        $validated = $request->validate([
            'comment' => 'required|max:255|min:4'
        ]);
        ForumComment::create([
            'forum_id' => $forum->id,
            'user_id' => loggedUser()->id,
            'comment' => $validated['comment'],
            'status' => ForumComment::STATUS_PUBLISHED,
            'replied_id' => $replied->id
        ]);

        success('Yorumun başarıyla eklendi.');

        return back();
    }
}
