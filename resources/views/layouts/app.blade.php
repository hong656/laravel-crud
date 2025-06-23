<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course CRUD App</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        body { background-color: #f4f6f9; }
        .navbar { background: linear-gradient(135deg, #1a237e 0%, #0d47a1 100%) !important; }
        .card { border: none; border-radius: 0.5rem; box-shadow: 0 0 15px rgba(0,0,0,0.05); }
        .btn-primary { background-color: #1a237e; border-color: #1a237e; }
        .btn-primary:hover { background-color: #0d47a1; border-color: #0d47a1; }
        .table-light { background-color: #e9ecef; }
        .dropdown-menu .active {
            font-weight: bold;
            background-color: rgba(26, 35, 126, 0.1);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark shadow-sm">
    <div class="container">
        <a class="navbar-brand fw-bold" href="{{ route('courses.index') }}"><i class="bi bi-book-half"></i> Course Platform</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}" href="{{ route('courses.index') }}">
                        <i class="bi bi-book"></i> Courses
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle {{ request()->routeIs('authors.*') || request()->routeIs('categories.*') || request()->routeIs('reviews.*') ? 'active' : '' }}" href="#" id="navbarDropdownManage" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-gear-fill"></i> Manage
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownManage">
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('authors.*') ? 'active' : '' }}" href="{{ route('authors.index') }}">
                                <i class="bi bi-person-fill me-2"></i> Authors
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                                <i class="bi bi-tags-fill me-2"></i> Categories
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item {{ request()->routeIs('reviews.*') ? 'active' : '' }}" href="{{ route('reviews.index') }}">
                                <i class="bi bi-star-fill me-2"></i> Reviews
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">
    @yield('content')
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
