<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * Display a listing of reviews.
     */
    public function index()
    {
        $reviews = Review::with('product')->latest()->paginate(15);
        return view('reviews.index', compact('reviews'));
    }

    /**
     * Update the specified review (approval status).
     */
    public function update(Request $request, Review $review)
    {
        $request->validate([
            'is_approved' => 'required|boolean',
        ]);

        $review->update([
            'is_approved' => $request->is_approved,
        ]);

        $status = $review->is_approved ? 'approved' : 'disapproved';
        return redirect()->route('reviews.index')->with('success', "Review successfully {$status}.");
    }

    /**
     * Remove the specified review.
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review deleted successfully.');
    }
}
