@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h2 class="mb-0"><i class="bi bi-person-fill"></i> Authors</h2>
            <a href="{{ route('authors.create') }}" class="btn btn-primary"><i class="bi bi-plus-circle"></i> Add Author</a>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th class="text-center">Courses</th>
                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @forelse ($authors as $author)
                        <tr>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->email }}</td>
                            <td class="text-center">{{ $author->courses_count }}</td>
                            <td class="text-center">
                                <a href="{{ route('authors.edit', $author->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                <form action="{{ route('authors.destroy', $author->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="bi bi-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-4">No authors found.</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
