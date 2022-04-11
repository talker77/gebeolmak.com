<?php

namespace App\Http\Controllers\Forum;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Forum;

class HomeController extends Controller
{
    /**
     * Forum anasayfa bütün kategoriler burada listelenir.
     * kategori içierisinde alt kategoriler ve o kategoriye ait forum sayısı gözükür
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        $categories = Category::withCount(['sub_categories_active', 'forums_active'])
            ->with('sub_categories_active:id,title,slug,parent_category_id')
            ->where(['categorizable_type' => Forum::class, 'is_active' => 1, 'parent_category_id' => null])
            ->orderBy('title')->get();

        $recents = Blog::where(['is_active' => true])->latest()->take(6)->get();

        return view('site.forum.index', [
            'categories' => $categories,
            'recents' => $recents,
        ]);
    }


    /**
     * Forum Kategori sayfası
     */
    public function category(Category $category)
    {
        if ($category->is_active == false or $category->categorizable_type != Forum::class) abort(404, "Bu Kategori bulunamadı");

        $forums = Forum::withCount('active_comments')->where(['status' => Forum::STATUS_PUBLISHED, 'sub_category_id' => $category->id])->latest()->paginate();

        return view('site.forum.category', [
            'item' => $category,
            'forums' => $forums,
        ]);
    }
}
