<?php

namespace App\Http\Controllers\Backend\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
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
        return view('backend.admin.dashboard.dashboard');
    }
}
