<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Product\Urun;
use App\Models\Siparis;
use App\User;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class AnasayfaController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function contacts()
    {
        return json_decode(Contact::orderByDesc('id')->get());
    }

    public function cacheClear()
    {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('view:cache');
        Artisan::call('config:cache');
        Cache::forget('adminIndexData');
        Cache::flush();
        session()->flash('message', 'önbellek temizlendi');

        return redirect('/admin/home');
    }
}
