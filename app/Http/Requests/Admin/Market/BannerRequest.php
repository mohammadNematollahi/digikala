<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BannerRequest extends FormRequest
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
        if($this->isMethod("post")){
            return [
                "url" => "required|max:250|url",
                "position" => "required|in:0,1,2,3,4,5",
                "status" => "in:0,1",
                "image" => "required|image|mimes:jpg,png,pjp,jfif,svg,gif"
            ];
        }else{
            return [
                "url" => "required|max:250|url",
                "position" => "required|in:0,1,2,3,4,5",
                "status" => "in:0,1",
                "image" => "nullable|image|mimes:jpg,png,pjp,jfif,svg,gif"
            ];
        }
    }
}
