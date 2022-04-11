<?php

namespace App\Http\Middleware;

use App\Models\Ayar;
use App\Models\Blog;
use App\Models\Builder\Menu;
use App\Models\Category;
use App\Models\Kategori;
use Closure;
use Illuminate\Support\Facades\View;

class AddConfigToSiteMW
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $site = Ayar::getCache();
        $cacheCategories = $this->getCategories();
        $lastBlogs = Blog::where(['is_active' => true])->latest()->take(6)->get();

        View::share('site', $site);
        View::share('cacheCategories', $cacheCategories);
        View::share('lastBlogs', $lastBlogs);

        return $next($request);
    }

    private function getCategories()
    {
        return \Cache::remember('categories:blog', 0, function () {
            return Category::with(['sub_categories_active'])->where(['categorizable_type' => Blog::class, 'is_active' => 1, 'parent_category_id' => null])
                ->latest()
                ->get();
        });
    }
}
