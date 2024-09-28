<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailRequest extends FormRequest
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
            "subject" => "required|max:150|regex:/^[آ-یA-zء-ي _\-]+$/u",
            "published_at" => "required|numeric",
            "status" => "required|in:0,1",
            "body" => "required|regex:/^[آ-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u"
        ];
    }
}
