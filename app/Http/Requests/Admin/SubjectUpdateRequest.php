<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SubjectUpdateRequest extends FormRequest
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
            'subjectName' => 'required|min:2',
            'subjectCode'=>'nullable|min:2',
            'subjectDescription'=>'nullable|min:2',
            'parent'=>'nullable'
        ];
    }
}
