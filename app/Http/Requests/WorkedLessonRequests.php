<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WorkedLessonRequests extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'teacher_id' => ['required', 'string', 'max:255'],
            'students.*' => 'required|string|max:1',
            'class_room' => ['required'],
            'students.*' => ['required'],
            'status' => ['required'],
            'type' => ['required', 'string']
        ];
    }
}
