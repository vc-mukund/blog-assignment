<?php

namespace App\Http\Controllers\Backend\Admin\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * DashboardController
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * For view admin panel dashboard
     *
     * @return Illuminate\View\View
     */
    public function dashboard(): View
    {
        try {
            return view('backend.admin.dashboard.dashboard');
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
        }
    }
}
   