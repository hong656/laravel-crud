@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to Students
    </a>
    <div>
        <a href="{{ route('students.edit', $student->id) }}" class="btn btn-warning"><i class="bi bi-pencil-square"></i> Edit Student</a>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        {{-- Student Details Card --}}
        <div class="card mb-4">
            <div class="card-body text-center">
                <div class="mb-4">
                    <div class="avatar-lg mx-auto mb-3">
                        <div class="avatar-title bg-primary rounded-circle text-white fw-bold" style="width: 120px; height: 120px; font-size: 48px; display: flex; align-items: center; justify-content: center;">
                            {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                        </div>
                    </div>
                    <h1 class="card-title">{{ $student->first_name }} {{ $student->last_name }}</h1>
                    <p class="text-muted fs-5">{{ $student->email }}</p>
                </div>

                <div class="row text-start">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">Student ID Number</label>
                            <p class="mb-0">
                                @if($student->student_id_number)
                                <span class="badge bg-secondary fs-6">{{ $student->student_id_number }}</span>
                                @else
                                <span class="text-muted">Not provided</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">Major</label>
                            <p class="mb-0">
                                @if($student->major)
                                <span class="badge bg-info text-dark fs-6">{{ $student->major }}</span>
                                @else
                                <span class="text-muted">Not specified</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">Date of Birth</label>
                            <p class="mb-0">
                                @if($student->date_of_birth)
                                {{ $student->date_of_birth->format('F j, Y') }}
                                @else
                                <span class="text-muted">Not provided</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">Age</label>
                            <p class="mb-0">
                                @if($student->date_of_birth)
                                {{ $student->date_of_birth->age }} years old
                                @else
                                <span class="text-muted">Not available</span>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Additional Information Section --}}
        <div class="card">
            <div class="card-header">
                <h4 class="mb-0"><i class="bi bi-info-circle"></i> Additional Information</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">Member Since</label>
                            <p class="mb-0">{{ $student->created_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label fw-bold text-muted">Last Updated</label>
                            <p class="mb-0">{{ $student->updated_at->format('F j, Y') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <div class="card sticky-top" style="top: 20px;">
            <div class="card-header">
                <h5 class="mb-0 text-center">Student Summary</h5>
            </div>
            <div class="card-body">
                <div class="d-flex justify-content-center align-items-center mb-3">
                    <div class="text-center">
                        <div class="avatar-lg mx-auto mb-2">
                            <div class="avatar-title bg-primary rounded-circle text-white fw-bold" style="width: 80px; height: 80px; font-size: 32px; display: flex; align-items: center; justify-content: center;">
                                {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                            </div>
                        </div>
                        <h5 class="mb-1">{{ $student->first_name }} {{ $student->last_name }}</h5>
                        <p class="text-muted mb-0">{{ $student->email }}</p>
                    </div>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Student ID:
                        <strong>
                            @if($student->student_id_number)
                            {{ $student->student_id_number }}
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Major:
                        <strong>
                            @if($student->major)
                            {{ $student->major }}
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        Date of Birth:
                        <span>
                            @if($student->date_of_birth)
                            {{ $student->date_of_birth->format('M d, Y') }}
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </span>
                    </li>
                </ul>
            </div>
            <div class="card-footer bg-transparent border-0 p-3">
                <div class="d-grid gap-2">
                    <a href="{{ route('students.edit', $student->id) }}" class="btn btn-primary btn-lg">
                        <i class="bi bi-pencil-square"></i> Edit Student
                    </a>
                    <form action="{{ route('students.destroy', $student->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger w-100" onclick="return confirm('Are you sure you want to delete this student?')">
                            <i class="bi bi-trash"></i> Delete Student
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .avatar-lg {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection