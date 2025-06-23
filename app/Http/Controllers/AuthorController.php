<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Course;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct()
    {
        // This applies the CoursePolicy to all methods
        $this->authorizeResource(Course::class, 'course');
    }

    public function index()
    {
        $authors = Author::withCount('courses')->latest()->get();
        return view('authors.index', compact('authors'));
    }

    public function create()
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:authors',
            'bio' => 'nullable|string',
        ]);

        Author::create($request->all());

        return redirect()->route('authors.index')->with('success', 'Author created successfully.');
    }

    public function edit(Author $author)
    {
        return view('authors.edit', compact('author'));
    }

    public function update(Request $request, Author $author)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:authors,email,' . $author->id,
            'bio' => 'nullable|string',
        ]);

        $author->update($request->all());

        return redirect()->route('authors.index')->with('success', 'Author updated successfully.');
    }

    public function destroy(Author $author)
    {
        if ($author->courses()->count() > 0) {
            // If they do, redirect back with an error message
            return back()->with('error', 'This author cannot be deleted because they have existing courses.');
        }

        $author->delete();
        return redirect()->route('authors.index')->with('success', 'Author deleted successfully.');
    }
}
