<?php

namespace App\Http\Middleware\Admin;

use App\Models\Forum;
use App\Models\ForumComment;
use App\Models\Siparis;
use Closure;
use Illuminate\Support\Facades\View;

class AdminCountsMW
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
        $counts = [
            'forum' => [
                'pending' => Forum::where(['status' => Forum::STATUS_PENDING])
                    ->when(!loggedAdminUser()->isSuperAdmin(), function ($query) {
                        $query->where(['writer_id' => loggedAdminUser()->id]);
                    })
                    ->count(),
                'pending_comments' => ForumComment::where(['status' => ForumComment::STATUS_PENDING])
                    ->count(),
            ]
        ];
        View::share('counts', $counts);

        return $next($request);
    }
}
