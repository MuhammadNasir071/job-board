<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class AdzunaService
{
    protected $baseUrl;
    protected $appId;
    protected $appKey;

    public function __construct()
    {
        $this->baseUrl = config('services.adzuna.url');
        $this->appId = config('services.adzuna.app_id');
        $this->appKey = config('services.adzuna.app_key');
    }

    public function searchJobs($query = '', $location = '', $page = 1)
    {
        $url = "{$this->baseUrl}/jobs/gb/search/{$page}";
        $response = Http::timeout(60) // increase timeout to 60 seconds
                ->get($url, [
                    'app_id' => $this->appId,
                    'app_key' => $this->appKey,
                    'what' => $query,
                    'where' => $location,
                ]);

        return $response->json();
    }
}
