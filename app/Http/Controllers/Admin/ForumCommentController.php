<?php

namespace App\Http\Controllers\Admin;

use App\Models\ForumComment;
use App\Notifications\Forum\ForumCommentApprovedNotification;
use App\Notifications\Forum\ForumCommentRejectedNotification;
use Illuminate\Http\Request;

class ForumCommentController extends AdminController
{
    public function index()
    {
        return view('admin.forum.comment.index');
    }

    public function show(ForumComment $comment)
    {
        return view('admin.forum.comment.show', [
            'item' => $comment
        ]);
    }


    public function update(Request $request, ForumComment $comment)
    {
        $requestData = $request->validate([
            'status' => 'nullable|numeric',
        ]);
        if ($comment->status != $requestData['status']) {
            if ($comment->status == ForumComment::STATUS_PUBLISHED) {
                $comment->user->notify(new ForumCommentApprovedNotification($comment));
            } elseif ($comment->status == ForumComment::STATUS_REJECTED) {
                $comment->user->notify(new ForumCommentRejectedNotification($comment));
            }
        }
        $comment->update($requestData);
        success();

        return redirect(route('admin.forum.comment.edit', ['comment' => $comment->id]));
    }


    public function delete(ForumComment $comment)
    {
        $comment->delete();

        return $this->success();
    }
}
