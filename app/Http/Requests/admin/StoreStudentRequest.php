<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
                'name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'admission_number' => 'required|string|max:255|unique:users',
                'roll_number' => 'nullable|string|max:255',
                'class_id' => 'required|exists:classrooms,id',
                'gender' => 'required|in:male,female',
                'date_of_birth' => 'required|date',
                'religion' => 'nullable|string|max:255',
                'phone_number' => 'required|string|max:255',
                'admission_date' => 'required|date',
                'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'blood_type' => 'nullable|string|max:255',
                'height' => 'nullable|integer',
                'weight' => 'nullable|integer',
                'status' => 'required|in:active,inactive',
                'email' => 'required|email|unique:users',
                'password' => 'required|string|min:6|confirmed',
        ];
    }
}
