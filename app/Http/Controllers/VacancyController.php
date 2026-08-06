<?php

namespace App\Http\Controllers;

use App\Models\Vacancy;
use Illuminate\View\View;

class VacancyController extends Controller
{
    public function index(string $locale): View
    {
        $vacancies = Vacancy::published()->latest()->get();

        return view('vacancies.index', [
            'locale' => $locale,
            'vacancies' => $vacancies,
        ]);
    }
}
