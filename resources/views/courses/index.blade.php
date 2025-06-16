@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-list-ul"></i> Course List</h2>
    <a href="{{ route('courses.create') }}" class="btn btn-primary">
        <i class="bi bi-plus-circle"></i> Add Course
    </a>
</div>

@if (session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <i class="bi bi-check-circle"></i> {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

<div class="table-responsive">
    <table class="table table-hover align-middle">
        <thead class="table-light">
            <tr>
                <th class="text-center">#</th>
                <th>Image</th>
                <th>Title</th>
                <th>Description</th>
                <th class="text-center">Price</th>
                <th class="text-center">Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($courses as $course)
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>
                    @if($course->image)
                    <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="img-thumbnail" style="max-width: 100px; height: auto;">
                    @else
                    <div class="text-muted">No image</div>
                    @endif
                </td>
                <td>{{ $course->title }}</td>
                <td>{{ $course->description }}</td>
                <td class="text-center fw-bold">${{ number_format($course->price, 2) }}</td>
                <td class="text-center">
                    <div>
                        <a href="{{ route('courses.show', $course->id) }}" class="btn btn-info btn-sm" title="View">
                            <i class="bi bi-eye"></i>
                        </a>
                        <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning btn-sm" title="Edit">
                            <i class="bi bi-pencil"></i>
                        </a>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" title="Delete"
                                onclick="return confirm('Are you sure you want to delete this course?')">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-4">
                    <i class="bi bi-inbox display-6 d-block mb-2"></i>
                    No courses found. <a href="{{ route('courses.create') }}">Add your first course</a>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection