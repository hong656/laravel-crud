@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to Courses
        </a>
        <div>
            <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit Course</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            {{-- Course Details Card --}}
            <div class="card mb-4">
                @if($course->image)
                    <img src="{{ Storage::url($course->image) }}" class="card-img-top" alt="{{ $course->title }}" style="max-height: 450px; object-fit: cover;">
                @else
                    <img src="https://placehold.co/800x400/e2e8f0/7e8a9f?text=Course+Image" class="card-img-top" alt="Course Image">
                @endif
                <div class="card-body">
                    <h1 class="card-title">{{ $course->title }}</h1>
                    <div class="mb-3 text-muted">
                        <span>Created by <strong>{{ $course->author->name ?? 'Unknown Author' }}</strong></span> |
                        <span>Category: <span class="badge bg-primary">{{ $course->category->name ?? 'Uncategorized' }}</span></span>
                    </div>
                    <p class="card-text fs-5">{{ $course->description }}</p>
                </div>
            </div>

            {{-- Reviews Section --}}
            <div class="card">
                <div class="card-header">
                    {{-- FIX: Use null safe operator ?? to provide a default value --}}
                    <h4 class="mb-0"><i class="bi bi-star-half"></i> Student Reviews ({{ $course->reviews->count() ?? 0 }})</h4>
                </div>
                <div class="card-body">
                    {{-- Form to Add a New Review --}}
                    <div class="card bg-light p-3 mb-4">
                        <h5>Leave a Review</h5>
                        <form action="{{ route('reviews.store', $course) }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                    <option value="" disabled selected>Select a rating...</option>
                                    <option value="5">5 - Excellent</option>
                                    <option value="4">4 - Very Good</option>
                                    <option value="3">3 - Good</option>
                                    <option value="2">2 - Fair</option>
                                    <option value="1">1 - Poor</option>
                                </select>
                                @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea name="comment" id="comment" rows="3" class="form-control @error('comment') is-invalid @enderror" required placeholder="Tell us what you think..."></textarea>
                                @error('comment')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>

                    {{-- Existing Reviews List --}}
                    {{-- FIX: Use null safe operator ?? to provide a default empty array --}}
                    @forelse ($course->reviews ?? [] as $review)
                        <div class="d-flex mb-3 @if(!$loop->last) border-bottom pb-3 @endif">
                            <div class="flex-shrink-0 me-3">
                                <img src="https://placehold.co/50x50/e2e8f0/7e8a9f?text={{ substr($review->user->name, 0, 1) }}" class="rounded-circle" alt="{{ $review->user->name }}">
                            </div>
                            <div class="w-100">
                                <div class="d-flex justify-content-between">
                                    <strong>{{ $review->user->name }}</strong>
                                    <span class="text-warning">
                                     @for ($i = 0; $i < 5; $i++)
                                            <i class="bi {{ $i < $review->rating ? 'bi-star-fill' : 'bi-star' }}"></i>
                                        @endfor
                                </span>
                                </div>
                                <small class="text-muted">{{ $review->created_at->format('F j, Y') }}</small>
                                <p class="mt-2 mb-0">{{ $review->comment }}</p>
                            </div>
                        </div>
                    @empty
                        <p class="text-center">This course has no reviews yet. Be the first to leave a review!</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card sticky-top" style="top: 20px;">
                <div class="card-header">
                    <h5 class="mb-0 text-center">Course Details</h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-center align-items-center mb-3">
                        <span class="h1 mb-0 text-success fw-bold">${{ number_format($course->price, 2) }}</span>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Author: <strong>{{ $course->author->name ?? 'N/A' }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Category: <strong>{{ $course->category->name ?? 'N/A' }}</strong>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Last Updated: <span>{{ $course->updated_at->format('M d, Y') }}</span>
                        </li>
                    </ul>
                </div>
                <div class="card-footer bg-transparent border-0 p-3">
                    <div class="d-grid gap-2">
                        <button class="btn btn-primary btn-lg"><i class="bi bi-cart-plus-fill"></i> Enroll Now</button>
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Are you sure you want to delete this course?')">
                                <i class="bi bi-trash"></i> Delete Course
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
