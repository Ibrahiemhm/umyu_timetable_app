<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCourseRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
        return [
            'department_id' => 'required|integer|exists:departments,id',
            'course_category_id' => 'required|integer|exists:course_categories,id',
            'semester_id' => 'required|integer|exists:semesters,id',
            'title' => 'required|string|max:255',
            'course_code' => 'required|string|max:20',
            'number_of_students' => 'required|integer',
        ];
    }
}
