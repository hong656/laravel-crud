<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Category;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with(['author', 'category'])->latest()->get();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $authors = Author::all();
        $categories = Category::all();
        return view('courses.create', compact('authors', 'categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
//            'author_id' => 'required|exists:authors,id',
//            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        try {
            if ($request->hasFile('image')) {
                $path = $request->file('image')->store('courses', 'public');
                $data['image'] = $path;
            }

            $course = Course::create($data);
            Log::info('Course created successfully:', ['course_id' => $course->id]);

            return redirect()->route('courses.index')->with('success', 'Course created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating course: ' . $e->getMessage());
            return back()->with('error', 'Error creating course: ' . $e->getMessage())->withInput();
        }
    }

    public function show(Course $course)
    {
        // FIX: Eager load all necessary relationships.
        $course->load(['author', 'category', 'reviews.user']);
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $authors = Author::all();
        $categories = Category::all();
        // FIX: Eager load reviews for the edit page as well.
        $course->load('reviews.user');
        return view('courses.edit', compact('course', 'authors', 'categories'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        try {
            if ($request->hasFile('image')) {
                if ($course->image) {
                    Storage::disk('public')->delete($course->image);
                }
                $path = $request->file('image')->store('courses', 'public');
                $data['image'] = $path;
            }

            $course->update($data);
            Log::info('Course updated successfully:', ['course_id' => $course->id]);

            return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating course: ' . $e->getMessage());
            return back()->with('error', 'Error updating course: ' . $e->getMessage())->withInput();
        }
    }

    public function destroy(Course $course)
    {
        try {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $course->delete();
            return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
        } catch (\Exception $e) {
            Log::error('Error deleting course: ' . $e->getMessage());
            return back()->with('error', 'Error deleting course: ' . $e->getMessage());
        }
    }
}
