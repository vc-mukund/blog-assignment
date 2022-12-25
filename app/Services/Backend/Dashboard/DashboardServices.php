<?php

namespace App\Services\Backend\Dashboard;

use App\Services\Core\Services;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * This services provide different method such as 
 * find all blogs data, 
 * find all users data,  
 */
class DashboardServices extends Services
{
    /**
     * BlogService Constructor
     *
     * @return void
     */
    public function __construct()
    {
        $this->modelUser = config('model-variable.models.user.class');
        $this->modelBlog = config('model-variable.models.blog.class');
    }

    /**
     * For show all Blog list
     *
     * @return object
     */
    public function BlogList(): object
    {
        try {
            return $this->modelBlog::select(DB::raw("(COUNT(*)) as count"), DB::raw("MONTHNAME(created_at) as month_name"))
                ->whereYear('created_at', date('Y'))
                ->groupBy('month_name')
                ->get();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }

    /**
     * For find all users with blogs
     *
     * @return object
     */
    public function userList(): object
    {
        try {
            return $this->modelUser::with('blog')->get();
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
