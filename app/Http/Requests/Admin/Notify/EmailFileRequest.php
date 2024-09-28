<?php

namespace App\Http\Requests\Admin\Notify;

use Illuminate\Foundation\Http\FormRequest;

class EmailFileRequest extends FormRequest
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
        if($this->isMethod("post"))
        {
            return [
                "file" => "file|required|max:6000|mimes:rar,zip,text",
                "status" => "required|in:0,1"
            ];
        }else{
            return [
                "file" => "file|nullable|max:6000|mimes:rar,zip,text",
                "status" => "required|in:0,1"
            ]; 
        }
    }
}
