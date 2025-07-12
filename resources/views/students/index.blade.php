@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h2 class="mb-0"><i class="bi bi-list-ul"></i> Student List</h2>
        <a href="{{ route('students.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Add New Student
        </a>
    </div>
    <div class="card-body">
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th class="text-center">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Student ID</th>
                        <th>Major</th>
                        <th class="text-center">Date of Birth</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <div class="d-flex align-items-center">
                                <div class="avatar-sm me-1">
                                    <div class="avatar-title bg-primary rounded-circle text-white fw-bold text-center" style="width: 30px; height: 30px; padding-top: 4px;">
                                        {{ strtoupper(substr($student->first_name, 0, 1) . substr($student->last_name, 0, 1)) }}
                                    </div>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $student->first_name }} {{ $student->last_name }}</div>
                                </div>
                            </div>
                        </td>
                        <td>{{ $student->email }}</td>
                        <td>
                            @if($student->student_id_number)
                            <span class="badge bg-secondary">{{ $student->student_id_number }}</span>
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td>
                            @if($student->major)
                            <span class="badge bg-info text-dark">{{ $student->major }}</span>
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td class="text-center">
                            @if($student->date_of_birth)
                            {{ $student->date_of_birth->format('M d, Y') }}
                            @else
                            <span class="text-muted">N/A</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <a href="{{ route('students.show', $student->id) }}" class="btn btn-sm btn-outline-info" title="View"><i class="bi bi-eye"></i></a>
                            <a href="{{ route('students.edit', $student->id) }}" class="btn btn-sm btn-outline-warning" title="Edit"><i class="bi bi-pencil"></i></a>
                            <form action="{{ route('students.destroy', $student->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" title="Delete" onclick="return confirm('Are you sure you want to delete this student?')"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <i class="bi bi-inbox display-4 d-block mb-2 text-muted"></i>
                            <p class="mb-0">No students have been added yet.</p>
                            <a href="{{ route('students.create') }}">Create the first one!</a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .avatar-sm {
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .avatar-title {
        font-size: 14px;
    }
</style>
@endsection