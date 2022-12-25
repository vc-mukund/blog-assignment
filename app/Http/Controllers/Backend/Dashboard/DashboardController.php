<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\Backend\Dashboard\DashboardServices;
use Illuminate\View\View;

/**
 * This controller provide method such as 
 * display admin dashboard
 */
class DashboardController extends Controller
{
    /**
     * DashboardController
     *
     * @return void
     */
    public function __construct(
        protected DashboardServices $services,
    ) {
    }

    /**
     * For view admin panel dashboard
     *
     * @return Illuminate\View\View
     */
    public function dashboard(): View
    {
        $users = $this->services->userList();
        foreach ($users as $user) {
            $fname[] = $user->fname;
            $blog[] = $user->blog->count();
        }

        $blogs = $this->services->blogList();
        foreach ($blogs as $item) {
            $count[] = $item->count;
        }

        return view('backend.admin.dashboard.dashboard', compact('fname', 'blog', 'count'));
    }
}
