@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0"><i class="bi bi-star-fill"></i> All Student Reviews</h2>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="list-group">
                @forelse ($reviews as $review)
                    <div class="list-group-item list-group-item-action flex-column align-items-start mb-3 border rounded-3 shadow-sm">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">
                                <a href="{{ route('courses.show', $review->course) }}" class="text-decoration-none">{{ $review->course->title ?? 'Deleted Course' }}</a>
                            </h5>
                            <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                        </div>
                        <div class="d-flex w-100 justify-content-between align-items-center mb-1">
                            <small class="text-muted">By: <strong>{{ $review->user->name ?? 'Anonymous' }}</strong></small>
                            <span class="text-warning">
                            @for ($i = 0; $i < 5; $i++)
                                    <i class="bi {{ $i < $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                @endfor
                            <span class="ms-1">({{ $review->rating }}.0)</span>
                        </span>
                        </div>
                        <p class="mb-1">{{ $review->comment }}</p>
                        <div class="mt-2 text-end">
                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this review?')">
                                    <i class="bi bi-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-5">
                        <i class="bi bi-inbox display-4 d-block mb-2 text-muted"></i>
                        <p class="mb-0">No reviews have been submitted yet.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
