<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Kategori;
use App\Repositories\Interfaces\UrunlerInterface;
use Illuminate\Http\Request;

class AramaController extends Controller
{

    public function ara(Request $request)
    {
        $items = [];
        $search = $request->get('search');
        if ($request->has('search')) {
            $items = Blog::where(['is_active' => true])->where('title', 'like', "%$search%")->latest()->paginate();
        } else if ($tag = $request->get('tag')) {
            $items = Blog::whereJsonContains('tags',[$tag])->where(['is_active' => true])->latest()->paginate();
        }

        $populars = Blog::where(['is_active' => true])
            ->latest('view_count')->take(10)->get();


        return view('site.arama.arama', [
            'items' => $items,
            'populars' => $populars
        ]);
    }

    public function headerSearchBarOnChangeWithAjax()
    {
        $categories = Kategori::getAllActiveCategoriesCache()->toArray();

        return response()->json($categories);
    }

    public function searchPageFilterWithAjax(Request $request)
    {
        $query = $request->get('q');
        $categoryId = $request->get('cat', null);
        $orderType = $request->get('orderBy', null);
        $currentPage = $request->get('page', 1);
        $selectedSubAttributeListFromRequest = $request->get('secimler');
        $selectedBrandIdListFromRequest = $request->get('brands');
        $subAttributeIdList = [];
        if (null !== $selectedSubAttributeListFromRequest) {
            foreach ($selectedSubAttributeListFromRequest as $s) {
                if (null !== $s) {
                    $subAttributeIdList[] = array_map('intval', explode(',', $s));
                }
            }
        }
        $data = $this->_productService->getProductsAndAttributeSubAttributesByFilter($categoryId, $query, $currentPage, $subAttributeIdList, $selectedBrandIdListFromRequest, $orderType);

        return response()->json($data);
    }
}
