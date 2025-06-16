@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-book"></i> Course Details</h2>
        <div>
                <a href="{{ route('courses.edit', $course->id) }}" class="btn btn-warning">
                        <i class="bi bi-pencil"></i> Edit Course
                </a>
                <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
                        <i class="bi bi-arrow-left"></i> Back to List
                </a>
        </div>
</div>

<div class="row">
        <div class="col-md-8">
                <div class="card mb-3">
                        <div class="card-body">
                                <h3 class="card-title mb-4">{{ $course->title }}</h3>

                                @if($course->image)
                                <div class="mb-4">
                                        <img src="{{ Storage::url($course->image) }}" alt="{{ $course->title }}" class="img-fluid rounded" style="max-height: 300px;">
                                </div>
                                @endif

                                <div class="mb-4">
                                        <p class="card-text">{{ $course->description ?: 'No description provided.' }}</p>
                                </div>
                        </div>
                </div>
        </div>

        <div class="col-md-4">
                <div class="card mb-3">
                        <div class="card-body">
                                <h5 class="card-title text-muted mb-3">Course Information</h5>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted">Price:</span>
                                        <span class="h4 mb-0 text-primary">${{ number_format($course->price, 2) }}</span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center mb-3">
                                        <span class="text-muted">Created:</span>
                                        <span>{{ $course->created_at->format('M d, Y') }}</span>
                                </div>

                                <div class="d-flex justify-content-between align-items-center">
                                        <span class="text-muted">Last Updated:</span>
                                        <span>{{ $course->updated_at->format('M d, Y') }}</span>
                                </div>
                        </div>
                </div>

                <div class="d-grid gap-2">
                        <form action="{{ route('courses.destroy', $course->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger w-100"
                                        onclick="return confirm('Are you sure you want to delete this course?')">
                                        <i class="bi bi-trash"></i> Delete Course
                                </button>
                        </form>
                </div>
        </div>
</div>
@endsection