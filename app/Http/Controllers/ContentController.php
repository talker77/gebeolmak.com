<?php

namespace App\Http\Controllers;

use App\Models\Content;
use App\Repositories\Interfaces\IcerikYonetimInterface;

class ContentController extends Controller
{

    public function detail(Content $content)
    {
        if (\View::exists("site.content.static." . $content->slug)) {
            return view("site.content.static." . $content->slug);
        }
        return view('site.content.detail', [
            'item' => $content
        ]);
    }
}
