<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CommonDiscountReqeust extends FormRequest
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
            "title" => "required|persian_alpha|max:250",
            "percentage" => "required|numeric",
            "discount_ceiling" => "required|numeric",
            "end_date" => "required|numeric",
            "start_date" => "required|numeric",
            "status" => "required|in:0,1",
            "minimal_order_amount" => "required|numeric",
        ];
    }
}
