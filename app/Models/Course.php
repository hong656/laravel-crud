<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'title',
        'description',
        'price',
        'image',
        'author_id',
        'category_id'
    ];

    /**
     * Get the author that owns the course.
     */
    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    /**
     * Get the category that the course belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the reviews for the course.
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
