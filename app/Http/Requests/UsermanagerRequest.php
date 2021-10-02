<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UsermanagerRequest extends FormRequest
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
            "email"=>"required",
            "name" => "required",
            "username" => "required|min:6|alpha_dash",
            'password' => "required|string|min:8|confirmed",
            "mobile" => "required|digits:10",
        ];
    }
}
