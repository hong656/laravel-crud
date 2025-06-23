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
        {{-- Main course details --}}
        <div class="col-lg-8">
            <div class="card mb-4">
                @if($course->image)
                    <img src="{{ Storage::url($course->image) }}" class="card-img-top" alt="{{ $course->title }}" style="max-height: 450px; object-fit: cover;">
                @else
                    <img src="https://placehold.co/800x400/e2e8f0/7e8a9f?text=Course+Image" class="card-img-top" alt="Course Image">
                @endif
                <div class="card-body">
                    <h1 class="card-title display-5">{{ $course->title }}</h1>
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
                    <h4 class="mb-0"><i class="bi bi-star-half"></i> Student Reviews ({{ $course->reviews->count() }})</h4>
                </div>
                <div class="card-body">
                    {{-- Form to Add a New Review --}}
                    <div class="card bg-light p-3 mb-4">
                        <h5>Leave a Review</h5>

                        @if (session('success'))
                            <div class="alert alert-success mt-2">{{ session('success') }}</div>
                        @endif

                        <form action="{{ route('reviews.store', $course) }}" method="POST" class="mt-2">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating</label>
                                <select name="rating" id="rating" class="form-select @error('rating') is-invalid @enderror" required>
                                    <option value="" disabled selected>Select a rating...</option>
                                    <option value="5" {{ old('rating') == 5 ? 'selected' : '' }}>5 - Excellent</option>
                                    <option value="4" {{ old('rating') == 4 ? 'selected' : '' }}>4 - Very Good</option>
                                    <option value="3" {{ old('rating') == 3 ? 'selected' : '' }}>3 - Good</option>
                                    <option value="2" {{ old('rating') == 2 ? 'selected' : '' }}>2 - Fair</option>
                                    <option value="1" {{ old('rating') == 1 ? 'selected' : '' }}>1 - Poor</option>
                                </select>
                                @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment</label>
                                <textarea name="comment" id="comment" rows="3" class="form-control @error('comment') is-invalid @enderror" required placeholder="Tell us what you think...">{{ old('comment') }}</textarea>
                                @error('comment')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>

                    {{-- Existing Reviews List --}}
                    @forelse ($course->reviews as $review)
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
                        <p class="text-center text-muted">This course has no reviews yet. Be the first to leave a review!</p>
                    @endforelse
                </div>
            </div>
        </div>

        {{-- Sticky sidebar --}}
        <div class="col-lg-4">
            {{-- Content omitted for brevity... same as before --}}
        </div>
    </div>
@endsection