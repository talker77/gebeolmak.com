<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Follow;
use App\Models\Forum;
use Illuminate\Http\Request;

class ForumWatchesController extends Controller
{
    /**
     * kullanıcının izlemeye aldığı forumlar
     */
    public function index()
    {
        $forums = Follow::where(['user_id' => loggedUser()->id, 'followable_type' => Forum::class])->latest()->paginate();

        return view('site.forum.watches', [
            'forums' => $forums
        ]);
    }

    /**
     * kullanıcının izlemeye aldığı forumlar
     */
    public function store(Forum $forum)
    {
        Follow::create([
            'user_id' => loggedUser()->id,
            'followable_type' => Forum::class,
            'followable_id' => $forum->id
        ]);
        success("Forum izleme listesine eklendi");

        return back();
    }
}
