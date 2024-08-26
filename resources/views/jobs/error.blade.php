<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Fetching Jobs</title>
    <!-- Include your CSS files here -->
</head>
<body>
    <h1>Oops! Something went wrong.</h1>
    <p>{{ $message }}</p>
    <a href="{{ route('jobs.index') }}">Try Again</a>
</body>
</html>
