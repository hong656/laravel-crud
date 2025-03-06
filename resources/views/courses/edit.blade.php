@extends('layouts.app')

@section('content')
    <h2>Edit Course</h2>
    <form action="{{ route('courses.update', $course->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{ $course->title }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ $course->description }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Price</label>
            <input type="number" name="price" class="form-control" value="{{ $course->price }}" step="0.01" required>
        </div>
        <button type="submit" class="btn btn-success">Update</button>
    </form>
@endsection
