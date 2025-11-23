<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Not Found</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container-fluid vh-100 d-flex align-items-center justify-content-center">
        <div class="text-center">
            <div class="mb-4">
                <h1 class="display-1 text-danger fw-bold">404</h1>
                <h2 class="h4 text-muted">Page Not Found</h2>
            </div>
            <p class="lead mb-4">The page that you are trying to access doesn't exists.</p>
            <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-primary">Go Back</a>
        </div>
    </div>
</body>
</html>
