<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class DashboardController extends Controller
{
    /**
     * Redirect to the default admin section.
     */
    public function index(): RedirectResponse
    {
        return redirect()->route('admin.services.index');
    }
}
