<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class BrandRequest extends FormRequest
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
                "persian_name" => "required|max:150|persian_alpha_num",
                "original_name" => "required|max:150|regex:/^[A-z0-9 ]+$/",
                "tags" => "required|regex:/^[آ-ی, A-z۰-۹ء-ي]+$/u|max:250",
                "status" => "in:0,1",
                "logo" => "required|image|mimes:jpg,png,pjp,jfif,svg"
            ];
        }else{
            return [
                "persian_name" => "required|max:150|persian_alpha_num",
                "original_name" => "required|max:150|regex:/^[A-z0-9 ]+$/",
                "tags" => "required|regex:/^[آ-ی, A-z۰-۹ء-ي]+$/u|max:250",
                "status" => "in:0,1",
                "logo" => "nullable|image|mimes:jpg,png,pjp,jfif,svg"
            ];
        }
    }
}
