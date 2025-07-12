<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $students = Student::with(['advisor', 'department'])->all(); // Fetch all students with relationships
        return view('students.index', compact('students')); // Pass them to a view
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $advisors = Author::all();
        $departments = Category::all();
        return view('students.create', compact('advisors', 'departments')); // Show the form to create a new student
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students',
            'date_of_birth' => 'nullable|date',
            'major' => 'nullable|string|max:255',
            'student_id_number' => 'nullable|string|max:255|unique:students',
            'advisor_id' => 'nullable|exists:authors,id',
            'department_id' => 'nullable|exists:categories,id',
        ]);

        // Create a new student record in the database
        Student::create($request->all());

        // Redirect back with a success message
        return redirect()->route('students.index')->with('success', 'Student created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student->load(['advisor', 'department']);
        return view('students.show', compact('student')); // Show details of a specific student
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $advisors = Author::all();
        $departments = Category::all();
        return view('students.edit', compact('student', 'advisors', 'departments')); // Show the form to edit a student
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // Validate the incoming request data
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:students,email,' . $student->id, // Unique email, but ignore current student's email
            'date_of_birth' => 'nullable|date',
            'major' => 'nullable|string|max:255',
            'student_id_number' => 'nullable|string|max:255|unique:students,student_id_number,' . $student->id, // Unique student ID, but ignore current student's ID
            'advisor_id' => 'nullable|exists:authors,id',
            'department_id' => 'nullable|exists:categories,id',
        ]);

        // Update the student record in the database
        $student->update($request->all());

        // Redirect back with a success message
        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete(); // Delete the student record

        // Redirect back with a success message
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}
