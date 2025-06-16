<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body {
            background-color: #e9ecef;
        }

        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, .1);
            background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%) !important;
        }

        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, .075);
            border: none;
            border-radius: 0.5rem;
            background-color: #ffffff;
        }

        .btn {
            border-radius: 0.375rem;
        }

        .table {
            background-color: #ffffff;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .table-hover tbody tr:hover {
            background-color: #f1f3f5;
        }

        .btn-primary {
            background-color: #1a237e;
            border-color: #1a237e;
        }

        .btn-primary:hover {
            background-color: #0d47a1;
            border-color: #0d47a1;
        }

        .btn-info {
            background-color: #0288d1;
            border-color: #0288d1;
            color: white;
        }

        .btn-info:hover {
            background-color: #0277bd;
            border-color: #0277bd;
            color: white;
        }

        .btn-warning {
            background-color: #f57c00;
            border-color: #f57c00;
            color: white;
        }

        .btn-warning:hover {
            background-color: #ef6c00;
            border-color: #ef6c00;
            color: white;
        }

        .btn-danger {
            background-color: #d32f2f;
            border-color: #d32f2f;
        }

        .btn-danger:hover {
            background-color: #c62828;
            border-color: #c62828;
        }

        .alert-success {
            background-color: #e8f5e9;
            border-color: #c8e6c9;
            color: #2e7d32;
        }

        .form-control:focus {
            border-color: #1a237e;
            box-shadow: 0 0 0 0.25rem rgba(26, 35, 126, 0.25);
        }

        .input-group-text {
            background-color: #f8f9fa;
            border-color: #ced4da;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand fw-bold" href="{{ route('courses.index') }}">
                <i class="bi bi-book"></i> Course App
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses.index') }}">
                            <i class="bi bi-house"></i> Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses.index') }}">
                            Course List
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="card">
            <div class="card-body p-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>