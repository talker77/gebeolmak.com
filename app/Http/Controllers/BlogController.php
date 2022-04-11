<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Forum;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function detail(Blog $blog)
    {
        $blog->load(['category', 'sub_category', 'writer']);

        $populars = Blog::where(['is_active' => true])
            ->where(function ($query) use ($blog) {
                $query->where('category_id', $blog->category_id)->orWhere('sub_category_id', $blog->sub_category_id);
            })
            ->where('id', '!=', $blog->id)
            ->latest('view_count')->take(3)->get();


        $forumCategories = Category::where(['categorizable_type' => Forum::class, 'is_active' => 1, 'parent_category_id' => null])
            ->orderBy('title')->get();

        return view('site.blog.detail', [
            'item' => $blog,
            'populars' => $populars,
            'forumCategories' => $forumCategories
        ]);
    }


    public function createComment(Request $request, Blog $blog)
    {
        if (!$blog->is_active) abort(403);
        $hasComment = Comment::where(['commentable_type' => Blog::class, 'commentable_id' => $blog->id, 'ip_address' => $request->ip()])->count();

        if ($hasComment) {
            return back()->withErrors("Zaten daha önce yorum yaptınız");
        }

        $validated = $request->validate([
            'comment' => 'required|max:255|string',
            'name' => 'required|max:100|string',
            'surname' => 'required|max:100|string',
            'email' => 'required|max:100|string',
            'message' => 'required|max:255|string',
        ]);
        $validated = array_merge($validated, [
            'ip_address' => $request->ip(),
            'commentable_type' => Blog::class,
            'commentable_id' => $blog->id,
        ]);
        Comment::create($validated);
        success("Yorumun başarıyla eklendi");

        return back();
    }
}
