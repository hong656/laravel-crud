<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        try {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Log the image details
                Log::info('Uploading image:', [
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize(),
                    'new_name' => $imageName
                ]);

                // Store the image in public disk
                $path = $image->storeAs('courses', $imageName, 'public');

                if ($path) {
                    $data['image'] = $path;
                    Log::info('Image stored successfully at: ' . $path);
                } else {
                    Log::error('Failed to store image');
                }
            }

            $course = Course::create($data);
            Log::info('Course created successfully:', ['course_id' => $course->id]);

            return redirect()->route('courses.index')->with('success', 'Course created successfully.');
        } catch (\Exception $e) {
            Log::error('Error creating course: ' . $e->getMessage());
            return back()->with('error', 'Error creating course: ' . $e->getMessage());
        }
    }

    public function show(Course $course)
    {
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(Request $request, Course $course)
    {
        $request->validate([
            'title' => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $data = $request->all();

        try {
            if ($request->hasFile('image')) {
                // Delete old image
                if ($course->image) {
                    Storage::disk('public')->delete($course->image);
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();

                // Log the image details
                Log::info('Updating image:', [
                    'original_name' => $image->getClientOriginalName(),
                    'mime_type' => $image->getMimeType(),
                    'size' => $image->getSize(),
                    'new_name' => $imageName
                ]);

                // Store the image in public disk
                $path = $image->storeAs('courses', $imageName, 'public');

                if ($path) {
                    $data['image'] = $path;
                    Log::info('Image updated successfully at: ' . $path);
                } else {
                    Log::error('Failed to store updated image');
                }
            }

            $course->update($data);
            Log::info('Course updated successfully:', ['course_id' => $course->id]);

            return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
        } catch (\Exception $e) {
            Log::error('Error updating course: ' . $e->getMessage());
            return back()->with('error', 'Error updating course: ' . $e->getMessage());
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
