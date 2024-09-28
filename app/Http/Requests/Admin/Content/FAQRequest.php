<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class FAQRequest extends FormRequest
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
            "question" => "required|regex:/^[آ-ی A-z0-9?؟!.)(,:\"'۰-۹]+$/u",
            "answer" => "required|regex:/^[آ-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u",
            "tags" => "required|regex:/^[آ-ی, A-z۰-۹ء-ي]+$/u|max:250",
            "status" => "required|in:0,1"
        ];
    }
}
