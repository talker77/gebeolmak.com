<?php

namespace App\Http\Controllers\Admin;

use App\Models\Auth\Role;
use App\Models\Category;
use App\Models\Forum;
use App\Notifications\Forum\ForumApprovedNotification;
use App\Notifications\Forum\ForumRejectedNotification;
use App\User;
use Illuminate\Http\Request;
use MuratEnes\LaravelMetaTags\Traits\MetaTaggable;

class ForumController extends AdminController
{
    public function index()
    {
        return view('admin.forum.index');
    }

    public function create()
    {
        return view('admin.forum.create', [
            'item' => new Forum(),
            'categories' => Category::where(['categorizable_type' => Forum::class])->get(),
            'subCategories' => [],
            'moderators' => User::whereIn('role_id', [Role::ROLE_SUPER_ADMIN, Role::ROLE_FORUM_MANAGER])->orderBy('name')->get()->toArray(),
        ]);
    }

    public function edit(Forum $forum)
    {
        $this->authorizeForUser(loggedAdminUser(), 'view', $forum);

        return view('admin.forum.create', [
            'item' => $forum,
            'categories' => Category::where(['categorizable_type' => Forum::class])->get(),
            'subCategories' => Category::where(['categorizable_type' => Forum::class, 'parent_category_id' => $forum->category_id])->get()->toArray(),
            'moderators' => User::whereIn('role_id', [Role::ROLE_SUPER_ADMIN, Role::ROLE_FORUM_MANAGER])->orderBy('name')->get()->toArray(),
        ]);
    }

    public function update(Request $request, Forum $forum)
    {
        $this->authorizeForUser(loggedAdminUser(), 'update', $forum);
        $requestData = $request->validate([
            'title' => 'required|string|max:200',
            'tags' => 'nullable|max:255',
            'description' => 'nullable|max:65535',
            'category_id' => 'nullable|numeric',
            'sub_category_id' => 'nullable|numeric',
            'status' => 'numeric|nullable'
        ]);
        $metaValidated = $request->validate(MetaTaggable::validation_rules());
        $oldStatus = $forum->status;
        if (loggedAdminUser()->isSuperAdmin()) {
            $requestData['manager_id'] = $request->get('manager_id', loggedAdminUser()->id);
            $requestData['status'] = $request->get('status');
        }


        $requestData['image'] = $this->uploadImage($request->file('image'), $forum->title, 'public/forum', $forum->image, Forum::MODULE_NAME);

        $forum->update($requestData);
        $forum->meta_tag()->updateOrCreate(['taggable_id' => $forum->id], $metaValidated);


        if (loggedAdminUser()->isSuperAdmin() and $oldStatus != $requestData['status']) {
            if ($requestData['status'] == Forum::STATUS_PUBLISHED) {
                $forum->writer->notify(new ForumApprovedNotification($forum));
            } elseif ($requestData['status'] == Forum::STATUS_REJECTED) {
                $forum->writer->notify(new ForumRejectedNotification($forum));
            }
        }

        success();

        return redirect(route('admin.forum.edit', $forum->id));
    }

    public function store(Request $request)
    {
        $this->authorizeForUser(loggedAdminUser(), 'create', Forum::class);
        $requestData = $request->validate([
            'title' => 'required|string|max:200',
            'tags' => 'nullable|max:255',
            'description' => 'nullable|max:65535',
            'category_id' => 'nullable|numeric',
            'sub_category_id' => 'nullable|numeric',
        ]);
        $metaValidated = $request->validate(MetaTaggable::validation_rules());

        if (loggedAdminUser()->isSuperAdmin()) {
            $requestData['manager_id'] = $request->get('manager_id', loggedAdminUser()->id);
            $requestData['status'] = $request->get('status');
        }
        $requestData['writer_id'] = loggedAdminUser()->id;

        $requestData['image'] = $this->uploadImage($request->file('image'), $requestData['title'], 'public/forum', null, Forum::MODULE_NAME);

        $forum = Forum::create($requestData);
        $forum->meta_tag()->updateOrCreate(['taggable_id' => $forum->id], $metaValidated);

        success();

        return redirect(route('admin.forum.edit', $forum->id));
    }

    public function delete(Forum $forum)
    {
        $this->authorizeForUser(loggedAdminUser(), 'delete', $forum);
        $forum->delete();

        return $this->success();
    }
}
