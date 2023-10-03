<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use App\Models\User;

class UpdateUserRequest extends FormRequest
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
        $rules = [
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:18',
            'gender' => 'required|string|in:Male,Female',
            'department_id' => 'required|integer|exists:departments,id',
        ];

        // Get the user ID from the route parameters
        $userId = $this->route('user');

        // Retrieve the user by ID
        $user = User::find($userId)->first();

        // Add email validation rule only if the submitted email is different from the current user's email
        if ($user && $this->input('email') !== $user->email) {
            $rules['email'] = 'required|string|email|max:255|unique:users';
        } else {
            // If the email is the same as the current user's email, no need to validate uniqueness
            $rules['email'] = 'required|string|email|max:255';
        }

        // Add image validation rule only if a new image is being uploaded
        if ($this->hasFile('image')) {
            $rules['image'] = [
                'required',
                File::image()->max(5 * 1024),
                'mimes:jpeg,png,jpg,gif',
            ];
        }

        return $rules;
    }

}
