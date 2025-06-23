@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Course</h2>
        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to List</a>
    </div>

    <form action="{{ route('courses.update', $course->id) }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-8">
                {{-- Course Details Card --}}
                <div class="card mb-4">
                    <div class="card-header">Course Details</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $course->title) }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description', $course->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Course Image</label>
                            @if($course->image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($course->image) }}" alt="Current Image" class="img-thumbnail" style="max-height: 200px;">
                                </div>
                            @endif
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            <small class="text-muted">Leave empty to keep the current image.</small>
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                {{-- Reviews Section --}}
                <div class="card">
                    <div class="card-header">
                        <h4 class="mb-0"><i class="bi bi-star-half"></i> Student Reviews ({{ $course->reviews->count() }})</h4>
                    </div>
                    <div class="card-body">
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
                                    <small class="text-muted">{{ $review->created_at->format('M d, Y') }}</small>
                                    <p class="mt-2 mb-0">{{ $review->comment }}</p>
                                </div>
                            </div>
                        @empty
                            <p class="text-center text-muted">This course has no reviews yet.</p>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card bg-light sticky-top" style="top: 20px;">
                    <div class="card-header">Configuration</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="author_id" class="form-label">Author <span class="text-danger">*</span></label>
                            <select class="form-select @error('author_id') is-invalid @enderror" id="author_id" name="author_id" required>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id', $course->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                @endforeach
                            </select>
                            @error('author_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $course->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" step="0.01" value="{{ old('price', $course->price) }}" required>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Update Course</button>
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x-circle"></i> Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection
