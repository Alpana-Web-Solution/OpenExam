<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ExamCreateReqeust extends FormRequest
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
            'name'=>'required|string',
            'description'=>'required|string',
            'start_date'=>'required|date',
            'end_date'=>'required|date',
            'duration'=>'required|numeric|min:300',
            'total_marks'=>'required|numeric',
            'default_mark'=>'nullable',
            'negative_mark'=>'nullable|numeric',
            'publish_result'=>'required|numeric',
            'instruction'=>'required|string'

        ];
    }
}
