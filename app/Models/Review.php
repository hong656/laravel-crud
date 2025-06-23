<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['course_id', 'user_id', 'rating', 'comment'];

    /**
     * Get the course that the review belongs to.
     */
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    /**
     * Get the user that created the review.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
