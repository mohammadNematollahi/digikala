<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class SMSRequest extends FormRequest
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
            "title" => "required|max:150|regex:/^[آ-یA-z?!؟% ]+$/u",
            "published_at" => "required|numeric",
            "body" => "required|regex:/^[آ-یA-z *0-9۰-۹ء-ي.,:=<>؟?!%-]+$/u",
            "status" => "required|in:0,1"
        ];
    }
}
