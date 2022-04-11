<?php

namespace App\Http\Controllers;

use App\Models\Ayar;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Forum;
use App\Models\Kategori;
use App\Models\Product\Urun;
use App\Models\Sepet;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class AnasayfaController extends Controller
{

    public function index()
    {
        $blogs = Blog::where(['is_active' => true])->whereNotNull('type')->latest()->take(200)->get();

        $forumCategories = Category::where(['categorizable_type' => Forum::class, 'is_active' => 1, 'parent_category_id' => null])
            ->latest('updated_at')->get();

        $lastHomeCategories = Category::where(['categorizable_type' => Blog::class, 'is_active' => true, 'show_homepage' => 1])
            ->whereNull('parent_category_id')
            ->with('last_active_blogs')
            ->latest('updated_at')
            ->take(7)->get();


        $mostViewed = Blog::select(['title', 'slug', 'image', 'category_id', 'id'])->with('category')
            ->where(['is_active' => true])->latest('view_count')->take(3)->get();


        $lastPosts = Blog::with('category')
            ->where(['is_active' => true])->latest()->take(4)->get();

        $tags = Blog::where(['is_active' => true])->whereNotNull('tags')->select('tags')->inRandomOrder()->take(10)->pluck('tags')->flatten()->take(6);

        return view('site.index', [
            'blogs' => $blogs,
            'forumCategories' => $forumCategories,
            'lastHomeCategories' => $lastHomeCategories,
            'mostViewed' => $mostViewed,
            'lastPosts' => $lastPosts,
            'tags' => $tags,
        ]);
    }

    /**
     * hakkımızda sayfası.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function about()
    {
        return view('site.main.about');
    }

    public function sitemap()
    {
        $products = Urun::orderBy('id', 'DESC')->take(1000)->get();
        $categories = Kategori::orderBy('id', 'DESC')->take(1000)->get();
        $now = Carbon::now()->toAtomString();
        $content = view('site.sitemap', compact('products', 'now', 'categories'));

        return response($content)->header('Content-Type', 'application/xml');
    }

    public function setLanguage(Request $request, $locale)
    {
        App::setLocale($locale);
        session()->put('locale', $locale);
        $lang = Ayar::getLanguageIdByShortName($locale);
        session()->put('lang_id', $lang);
        session()->put('currency_id', Ayar::getCurrencyId());
        session()->put('product_price_currency_field', Ayar::getCurrencyProductPriceFieldByLang($lang));
        if ($request->user()) {
            $this->matchSessionCartWithBasketItems(Sepet::getCurrentBasket());
            $request->user()->update(['locale' => Ayar::languages()[$lang][3]]);
        }

        return back();
    }
}
