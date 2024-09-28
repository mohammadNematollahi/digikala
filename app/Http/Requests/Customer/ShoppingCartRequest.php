<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class ShoppingCartRequest extends FormRequest
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
            "color_id" => "nullable|exists:product_colors,id",
            "warranty_id" => "nullable|exists:warranties,id",
            "number" => "required|numeric|min:1|max:5",
        ];
    }
}
