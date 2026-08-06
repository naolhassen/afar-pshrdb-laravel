<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\NewsArticle;
use App\Models\Page;
use App\Models\Vacancy;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'counts' => [
                'news' => NewsArticle::count(),
                'pages' => Page::count(),
                'announcements' => Announcement::count(),
                'vacancies' => Vacancy::count(),
            ],
        ]);
    }
}
