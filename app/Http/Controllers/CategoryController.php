<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Forum;
use Illuminate\Http\Request;

/**
 * Blog Category
 */
class CategoryController extends Controller
{
    /**
     *
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail(Request $request, Category $category)
    {
        if ($category->categorizable_type != Blog::class or !$category->is_active) abort(404, 'Aradığınız kategori bulunamadı');

        $blogs = Blog::with(['category'])->where(function ($query) use ($category) {
            $query->where('category_id', $category->id)->orWhere('sub_category_id', $category->id);
        })->where('is_active', true)
            ->when($request->get('search'), function ($query) use ($request) {
                $search = $request->get('search');
                $query->where('title', 'like', "%$search%");
            })
            ->latest()->paginate(20);

        $populars = Blog::where(['is_active' => true])
            ->where(function ($query) use ($category) {
                $query->where('category_id', $category->id)->orWhere('sub_category_id', $category->id);
            })
            ->latest('view_count')->take(3)->get();


        $forumCategories = Category::where(['categorizable_type' => Forum::class, 'is_active' => 1, 'parent_category_id' => null])
            ->orderBy('title')->get();


        return view('site.category.index', [
            'category' => $category,
            'blogs' => $blogs,
            'populars' => $populars,
            'forumCategories' => $forumCategories
        ]);
    }
}
