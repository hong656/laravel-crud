<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $reviews = Review::with(['course', 'user'])->latest()->get();
        return view('reviews.index', compact('reviews'));
    }

    public function store(Request $request, Course $course)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $course->reviews()->create([
            'user_id' => Auth::id(), // No fallback needed now
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Thank you for your review!');
    }

    public function destroy(Review $review)
    {
        $review->delete();
        return back()->with('success', 'Review deleted successfully.');
    }
}
