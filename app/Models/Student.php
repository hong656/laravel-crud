<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'date_of_birth',
        'major',
        'student_id_number',
        'advisor_id',
        'department_id',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_birth' => 'date', // Cast date_of_birth to a Carbon date instance
    ];

    /**
     * Get the advisor that supervises the student.
     */
    public function advisor()
    {
        return $this->belongsTo(Author::class, 'advisor_id');
    }

    /**
     * Get the department that the student belongs to.
     */
    public function department()
    {
        return $this->belongsTo(Category::class, 'department_id');
    }
}
