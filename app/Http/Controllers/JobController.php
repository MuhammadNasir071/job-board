<?php

namespace App\Http\Controllers;

use App\Services\AdzunaService;
use Illuminate\Http\Request;

class JobController extends Controller
{
    protected $adzunaService;

    public function __construct(AdzunaService $adzunaService)
    {
        $this->adzunaService = $adzunaService;
    }

    public function index(Request $request)
    {
        $query = $request->input('query', '');
        $location = $request->input('location', '');
        $page = $request->input('page', 1);

        $jobs = $this->adzunaService->searchJobs($query, $location, $page);

        if (isset($jobs['error']) && $jobs['error']) {
            // Handle error accordingly, e.g., display an error message
            return view('jobs.error', ['message' => $jobs['message']]);
        }

        return view('jobs.index', [
            'jobs' => $jobs['results'] ?? [],
            'location' => $location,
            'query' => $query,
            'total_results' => $jobs['count'] ?? 0,
            'page' => $page,
        ]);
    }
}
