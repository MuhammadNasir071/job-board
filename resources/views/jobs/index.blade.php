<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Find the latest {{ ucfirst($query) }} jobs in {{ ucfirst($location) }}.">
    <meta name="robots" content="index, follow">
    <title>{{ ucfirst($query) }} Jobs in {{ ucfirst($location) }} | Your Job Board Name</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Include your CSS files here -->
</head>

<body>
    <div class="row">
        <div class="container">
            <h1>{{ ucfirst($query) }} Jobs in {{ ucfirst($location) }}</h1>

            @if (count($jobs) > 0)
                <ol>
                    @foreach ($jobs as $job)
                        <li>
                            <a href="{{ $job['redirect_url'] }}" target="_blank">
                                <h3>{{ $job['title'] }} at {{ $job['company']['display_name'] ?? 'Unknown Company' }}
                                </h3>
                            </a>
                            <p> <b>Location:</b>  {{ $job['location']['display_name'] ?? 'Location not specified' }}</p>
                            <p><b>Salary:</b> {{ $job['salary_min'] ?? 'N/A' }}</p>
                            <p><b>Description:</b> {{ \Illuminate\Support\Str::limit($job['description'], 150) }}</p>
                        </li>

                        <!-- Structured Data (Schema.org JobPosting) -->
                        <script type="application/ld+json">
                {
                  "@context": "https://schema.org",
                  "@type": "JobPosting",
                  "title": "{{ $job['title'] }}",
                  "hiringOrganization": {
                    "@type": "Organization",
                    "name": "{{ $job['company']['display_name'] ?? 'Unknown Company' }}"
                  },
                  "jobLocation": {
                    "@type": "Place",
                    "address": {
                      "@type": "PostalAddress",
                      "addressLocality": "{{ $location }}",
                      "addressCountry": "GB"
                    }
                  },
                  "description": "{{ \Illuminate\Support\Str::limit($job['description'], 150) }}",
                  "datePosted": "{{ \Carbon\Carbon::parse($job['created']) }}",
                  "employmentType": "FULL_TIME",
                }
                </script>
                    @endforeach
                </ol>

                <!-- Pagination Links -->
                <div>


                    <nav aria-label="Page navigation" class="pagination-wrapper">
                        <ul class="pagination">
                            @if ($page > 1)
                                <li>
                                    <a href="{{ route('jobs.index', ['query' => $query, 'location' => $location, 'page' => $page - 1]) }}"
                                        aria-label="Previous">
                                        &laquo; Previous
                                    </a>
                                </li>
                            @endif

                            <li><a href="#" class="active">{{ $page }}</a></li>

                            @if (count($jobs) == 10)
                                <!-- Assuming 10 results per page -->
                                <li>
                                    <a href="{{ route('jobs.index', ['query' => $query, 'location' => $location, 'page' => $page + 1]) }}"
                                        aria-label="Next">
                                        Next &raquo;
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>

                </div>
            @else
                <p>No jobs found for "{{ ucfirst($query) }}" in "{{ ucfirst($location) }}". Please try different
                    search criteria.</p>
            @endif
        </div>
    </div>
</body>

</html>
