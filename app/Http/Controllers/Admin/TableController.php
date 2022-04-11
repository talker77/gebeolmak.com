<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Content;
use App\Models\Forum;
use App\Models\ForumComment;
use App\Models\Product\UrunFirma;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TableController extends Controller
{
    /**
     * admin contact page list.
     *
     * @return mixed
     * @throws \Exception
     *
     */
    public function contact()
    {
        $contacts = Contact::query();

        return Datatables::of($contacts)->make();
    }

    /**
     * @return mixed
     * @throws \Exception
     *
     */
    public function companies()
    {
        return Datatables::of(
            UrunFirma::with(['user', 'package'])
        )->make();
    }

    /**
     * @return mixed
     * @throws \Exception
     *
     */
    public function users()
    {
        return Datatables::of(
            User::with('role')
        )->make();
    }

    /**
     * @return mixed
     * @throws \Exception
     *
     */
    public function blogs()
    {
        return Datatables::of(
            Blog::with(['writer:name,surname,email,id', 'category:id,title', 'sub_category:id,title'])
                ->when(!loggedAdminUser()->isSuperAdmin(), function ($query) {
                    $query->where('writer_id', loggedAdminUser()->id);
                })
        )->make();
    }

    /**
     * @return mixed
     * @throws \Exception
     *
     */
    public function categories(Request $request)
    {
        return Datatables::of(
            Category::with(['parent_category'])->when($request->get('type'), function ($query) use ($request) {
                $query->where('categorizable_type', $request->get('type'));
            })
        )->make();
    }

    /**
     * @return mixed
     * @throws \Exception
     *
     */
    public function contents(Request $request)
    {
        return Datatables::of(
            Content::query()
        )->make();
    }

    /**
     * @return mixed
     * @throws \Exception
     *
     */
    public function banners(Request $request)
    {
        return Datatables::of(
            Banner::query()
        )->make();
    }

    /**
     * @return mixed
     * @throws \Exception
     *
     */
    public function forums(Request $request)
    {
        return Datatables::of(
            Forum::with(['writer:id,name,surname','manager:id,name,surname', 'category:id,title,categorizable_type', 'sub_category:id,title,categorizable_type'])
                ->when($request->has('status'), function ($query) use ($request) {
                    $query->where('status', $request->get('status'));
                })
                ->when(!loggedAdminUser()->isSuperAdmin(), function ($query) {
                    $query->where('manager_id', loggedAdminUser()->id);
                })
        )->addColumn('status_label', function(Forum $forum) {
            return $forum->status_label;
        })->make();
    }

    public function forumComments(Request $request)
    {
        return Datatables::of(
            ForumComment::with(['replied:id,comment','user:id,name,surname', 'forum:id,title,slug'])
                ->when($request->has('status'), function ($query) use ($request) {
                    $query->where('status', $request->get('status'));
                })
        )->make();
    }
}
