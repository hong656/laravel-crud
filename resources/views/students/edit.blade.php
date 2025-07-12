@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="mb-0"><i class="bi bi-pencil-square"></i> Edit Student</h2>
    <a href="{{ route('students.index') }}" class="btn btn-outline-secondary"><i class="bi bi-arrow-left"></i> Back to List</a>
</div>

<form action="{{ route('students.update', $student->id) }}" method="POST" class="needs-validation" novalidate>
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-md-8">
            {{-- Student Details Card --}}
            <div class="card mb-4">
                <div class="card-header">Student Details</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="first_name" class="form-label">First Name <span class="text-danger">*</span></label>
                                <input type="text" name="first_name" id="first_name" style="border: 1px solid black;" class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name', $student->first_name) }}" required>
                                @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="last_name" class="form-label">Last Name <span class="text-danger">*</span></label>
                                <input type="text" name="last_name" id="last_name" style="border: 1px solid black;" class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name', $student->last_name) }}" required>
                                @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" style="border: 1px solid black;" class="form-control @error('email') is-invalid @enderror"
                            value="{{ old('email', $student->email) }}" required>
                        @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="student_id_number" class="form-label">Student ID Number</label>
                        <input type="text" name="student_id_number" id="student_id_number" style="border: 1px solid black;" class="form-control @error('student_id_number') is-invalid @enderror"
                            value="{{ old('student_id_number', $student->student_id_number) }}">
                        @error('student_id_number')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <div class="mb-3">
                        <label for="major" class="form-label">Major</label>
                        <input type="text" name="major" id="major" style="border: 1px solid black;" class="form-control @error('major') is-invalid @enderror"
                            value="{{ old('major', $student->major) }}">
                        @error('major')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>

            {{-- Current Student Info Section --}}
            <div class="card">
                <div class="card-header">
                    <h4 class="mb-0"><i class="bi bi-info-circle"></i> Current Student Information</h4>
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Current Age</label>
                                <p class="mb-0">
                                    @if($student->date_of_birth)
                                    {{ $student->date_of_birth->age }} years old
                                    @else
                                    <span class="text-muted">Not available</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label fw-bold text-muted">Student ID</label>
                                <p class="mb-0">
                                    @if($student->student_id_number)
                                    <span class="badge bg-secondary">{{ $student->student_id_number }}</span>
                                    @else
                                    <span class="text-muted">Not provided</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card bg-light sticky-top" style="top: 20px;">
                <div class="card-header">Configuration</div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="date_of_birth" class="form-label">Date of Birth</label>
                        <input type="date" name="date_of_birth" id="date_of_birth" style="border: 1px solid black;" class="form-control @error('date_of_birth') is-invalid @enderror"
                            value="{{ old('date_of_birth', $student->date_of_birth ? $student->date_of_birth->format('Y-m-d') : '') }}">
                        @error('date_of_birth')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    {{-- Student Avatar Preview --}}
                    <div class="text-center mb-3">
                        <div class="avatar-lg mx-auto mb-2">
                            <div class="avatar-title bg-primary rounded-circle text-white fw-bold" style="width: 80px; height: 80px; font-size: 32px; display: flex; align-items: center; justify-content: center;">
                                {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                            </div>
                        </div>
                        <p class="text-muted mb-0">Student Avatar</p>
                    </div>
                </div>
            </div>
            <div class="d-grid gap-2 mt-4">
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save"></i> Update Student
                </button>
                <a href="{{ route('students.index') }}" class="btn btn-outline-secondary">
                    <i class="bi bi-x-circle"></i> Cancel
                </a>
            </div>
        </div>
    </div>
</form>

<script>
    // Form validation
    (function() {
        'use strict'
        var forms = document.querySelectorAll('.needs-validation')
        Array.prototype.slice.call(forms).forEach(function(form) {
            form.addEventListener('submit', function(event) {
                if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                }
                form.classList.add('was-validated')
            }, false)
        })
    })()
</script>

<style>
    .avatar-lg {
        display: flex;
        align-items: center;
        justify-content: center;
    }
</style>
@endsection