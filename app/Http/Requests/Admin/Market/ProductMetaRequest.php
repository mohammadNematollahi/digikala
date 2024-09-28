<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class ProductMetaRequest extends FormRequest
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
            "product_key" =>"required|regex:/^[آ-یA-z0-9\-۰-۹ء-ي]+$/u|max:250",
            "product_value" =>"required|regex:/^[آ-یA-z0-9\-۰-۹ء-ي ]+$/u|max:250",
        ];
    }
}
