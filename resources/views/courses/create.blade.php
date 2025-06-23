@extends('layouts.app')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0"><i class="bi bi-plus-circle"></i> Add New Course</h2>
        <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
    </div>

    <form action="{{ route('courses.store') }}" method="POST" class="needs-validation" enctype="multipart/form-data" novalidate>
        @csrf
        <div class="row">
            {{-- Main course details on the left --}}
            <div class="col-md-8">
                <div class="card mb-4">
                    <div class="card-header">Course Details</div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title <span class="text-danger">*</span></label>
                            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                            @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="5">{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="mb-3">
                            <label for="image" class="form-label">Course Image</label>
                            <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- Configuration options on the right --}}
            <div class="col-md-4">
                <div class="card bg-light sticky-top" style="top: 20px;">
                    <div class="card-header">Configuration</div>
                    <div class="card-body">
                        {{-- AUTHOR DROPDOWN --}}
                        <div class="mb-3">
                            <label for="author_id" class="form-label">Author <span class="text-danger">*</span></label>
                            <select class="form-select @error('author_id') is-invalid @enderror" id="author_id" name="author_id" required>
                                <option value="">Select an Author</option>
                                @foreach ($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                                @endforeach
                            </select>
                            @error('author_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- CATEGORY DROPDOWN --}}
                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category <span class="text-danger">*</span></label>
                            <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                                <option value="">Select a Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        {{-- PRICE INPUT --}}
                        <div class="mb-3">
                            <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" name="price" id="price" class="form-control @error('price') is-invalid @enderror" step="0.01" value="{{ old('price') }}" required>
                                @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-grid gap-2 mt-4">
                    <button type="submit" class="btn btn-primary"><i class="bi bi-save"></i> Save Course</button>
                    <a href="{{ route('courses.index') }}" class="btn btn-outline-secondary"><i class="bi bi-x-circle"></i> Cancel</a>
                </div>
            </div>
        </div>
    </form>
@endsection