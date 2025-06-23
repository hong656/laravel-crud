@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0"><i class="bi bi-list-ul"></i> Course List</h2>
            <a href="{{ route('courses.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-circle"></i> Add New Course
            </a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
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
                                @if($course->image)
                                    <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="img-thumbnail" style="width: 120px; height: 70px; object-fit: cover;">
                                @else
                                    <img src="https://placehold.co/120x70/e2e8f0/7e8a9f?text=No+Image" alt="No image" class="img-thumbnail">
                                @endif
                            </td>
                            <td><a href="{{ route('courses.show', $course->id) }}" class="text-dark fw-bold">{{ $course->title }}</a></td>
                            <td>{{ $course->author->name ?? 'N/A' }}</td>
                            <td><span class="badge bg-info text-dark">{{ $course->category->name ?? 'N/A' }}</span></td>
                            <td class="text-center fw-bold">${{ number_format($course->price, 2) }}</td>
                            <td class="text-center">
                                <a href="{{ route('courses.show', $course->id) }}" class="btn btn-sm btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this course?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5">
                                <i class="bi bi-inbox display-4 d-block mb-2 text-muted"></i>
                                <p class="mb-0">No courses have been added yet.</p>
                                <a href="{{ route('courses.create') }}">Create the first one!</a>
                            </td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
