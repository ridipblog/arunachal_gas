<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\View\View;
use Throwable;

class HomeController extends Controller
{
    /**
     * Display the public homepage with dynamic services.
     */
    public function index(): View
    {
        try {
            $services = Service::where('is_active', true)
                ->orderBy('order')
                ->orderBy('id')
                ->get();
        } catch (Throwable $e) {
            report($e);
            $services = collect();
        }

        return view('welcome', compact('services'));
    }
}
