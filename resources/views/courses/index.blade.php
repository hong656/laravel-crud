@extends('layouts.app')

@section('content')
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center bg-white">
            <h2 class="mb-0 h4"><i class="bi bi-list-ul me-2"></i> Course List</h2>
            @can('create', App\Models\Course::class)
                <a href="{{ route('courses.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Add New Course
                </a>
            @endcan
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                    <tr>
                        <th class="text-center">#</th>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Category</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($courses as $course)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ $course->image ? Storage::url($course->image) : 'https://placehold.co/120x70/eef2f7/7e8a9f?text=No+Image' }}"
                                     alt="{{ $course->title }}" class="img-thumbnail" style="width: 120px; height: 70px; object-fit: cover;">
                            </td>
                            <td>
                                <a href="{{ route('courses.show', $course->id) }}" class="text-decoration-none fw-bold">{{ $course->title }}</a>
                            </td>
                            <td>{{ $course->author->name ?? 'N/A' }}</td>
                            <td>
                                <span class="badge bg-secondary fw-normal">{{ $course->category->name ?? 'N/A' }}</span>
                            </td>
                            <td class="text-center fw-bold">${{ number_format($course->price, 2) }}</td>
                            <td class="text-center">
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-light border" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="bi bi-three-dots"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end">
                                        @can('view', $course)
                                            <li><a class="dropdown-item" href="{{ route('courses.show', $course->id) }}"><i class="bi bi-eye me-2"></i>View</a></li>
                                        @endcan
                                        @can('update', $course)
                                            <li><a class="dropdown-item" href="{{ route('courses.edit', $course->id) }}"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                        @endcan
                                        @can('delete', $course)
                                            <li><hr class="dropdown-divider"></li>
                                            <li>
                                                {{-- THIS IS THE CORRECTED DIRECT DELETE FORM --}}
                                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to permanently delete this course?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">
                                                        <i class="bi bi-trash3 me-2"></i>Delete
                                                    </button>
                                                </form>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox display-4 d-block mb-3 text-muted"></i>
                                <h5 class="mb-2">No Courses Found</h5>
                                <p class="mb-3 text-muted">Get started by adding your first course.</p>
                                @can('create', App\Models\Course::class)
                                    <a href="{{ route('courses.create') }}" class="btn btn-primary btn-sm">
                                        <i class="bi bi-plus-circle"></i> Create the first one
                                    </a>
                                @endcan
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- The Reusable Delete Modal has been removed. --}}
@endsection

{{-- The @push('scripts') section has been removed as it is no longer needed. --}}
