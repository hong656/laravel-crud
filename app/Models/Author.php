<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'bio'];

    /**
     * Get the courses for the author.
     */
    protected static function booted(): void
    {
        static::deleting(function (Author $author) {
            // Before deleting the author, delete all of their associated courses.
            $author->courses()->delete();
        });
    }
    public function courses()
    {
        return $this->hasMany(Course::class);
    }



}
