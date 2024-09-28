<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductCategoryRequest extends FormRequest
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
                "name" => "required|max:150|persian_alpha",
                "tags" => "required|regex:/^[آ-ی, A-z۰-۹ء-ي]+$/u|max:250",
                "description" => "required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u",
                "status" => "in:0,1",
                "show_in_menu" => "in:0,1",
                "image" => "required|image|mimes:jpg,png,pjp,jfif,svg",
                "parent_id" => "nullable|exists:product_categories,id",
            ];
        }else{
            return [
                "name" => "required|max:150|persian_alpha",
                "tags" => "required|regex:/^[آ-ی, A-z۰-۹ء-ي]+$/u|max:250",
                "description" => "required|regex:/^[ا-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u",
                "status" => "in:0,1",
                "show_in_menu" => "in:0,1",
                "image" => "nullable|image|mimes:jpg,png,pjp,jfif,svg",
                "parent_id" => "nullable|exists:product_categories,id",
            ];
        }
    }
}
