<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\Forum\ForumCreateRequest;
use App\Models\Category;
use App\Models\Follow;
use App\Models\Forum;
use App\Models\ForumComment;
use Illuminate\Support\Facades\Cache;

class ForumController extends Controller
{

    /**
     * @param Forum $forum
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show(Forum $forum)
    {
        if ($forum->status !== Forum::STATUS_PUBLISHED) abort(404, 'Aradığınız gönderi bulunamadı');

        $forum->load(['writer:id,name,surname', 'category:id,title,slug', 'sub_category:id,title']);

        Cache::remember((request()->ip().":".$forum->id),60,function () use ($forum){
            return $forum->increment('view_count');
        });

        $comments = ForumComment::with(['replied:id,comment', 'user:id,name,surname'])
            ->where(['forum_id' => $forum->id])->where('status', ForumComment::STATUS_PUBLISHED)->paginate(20);

        return view('site.forum.show', [
            'item' => $forum,
            'comments' => $comments
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = Category::with(['sub_categories'])->where(['categorizable_type' => Forum::class, 'is_active' => 1, 'parent_category_id' => null])->orderBy('title')->get();

        return view('site.forum.create', [
            'categories' => $categories
        ]);
    }

    /**
     * @param Forum $forum
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit(Forum $forum)
    {
        // todo : authorize
        $categories = Category::where(['categorizable_type' => Forum::class, 'is_active' => 1, 'parent_category_id' => null])->orderBy('title')->get();

        return view('site.forum.create', [
            'categories' => $categories,
            'item' => $forum
        ]);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function store(ForumCreateRequest $request)
    {
        $validated = $request->validated();

        $forum = Forum::create(array_merge($validated, [
            'writer_id' => loggedUser()->id,
            'status' => Forum::STATUS_PUBLISHED,
            'slug' => createSlugFromTitleByModel(Forum::class,$validated['title'],0),
            'category_id' => Category::find($validated['sub_category_id'])->parent_category_id
        ]));

        success('Konu başarılı şekilde oluşturuldu.');

        return redirect(route('forum.detail',['forum' => $forum->slug]));
    }

    /**
     * kullanıcının oluşturduğu forumlar
     */
    public function forums()
    {
        $forums = Forum::where(['writer_id' => loggedUser()->id])->latest()->paginate();

        return view('site.forum.my-posts', [
            'forums' => $forums
        ]);
    }


}
