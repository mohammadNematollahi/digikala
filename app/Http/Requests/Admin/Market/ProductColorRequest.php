<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductColorRequest extends FormRequest
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
            "color_name" => "required|persian_alpha",
            "color" => "required|regex:/^[#A-z0-9]+$/",
            "price_increase" => "required|numeric",
            "status" =>"required|in:0,1"
        ];
    }
}
