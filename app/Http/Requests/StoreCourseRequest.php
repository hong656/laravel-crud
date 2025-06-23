<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * This is handled by the CoursePolicy, so we can return true here.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // 'sometimes' on the image rule means it's only required if it's present in the request.
        // This makes it optional for updates where the user doesn't change the image.
        $imageRule = $this->isMethod('put') ? 'sometimes' : 'required';

        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'author_id' => 'required|exists:authors,id',
            'category_id' => 'required|exists:categories,id',
            'image' => [$imageRule, 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ];
    }
}
