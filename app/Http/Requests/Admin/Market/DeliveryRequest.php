<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class DeliveryRequest extends FormRequest
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
            "name" => "required|regex:/^[آ-یA-z0-9 ]+$/u",
            "delivery_time" => "nullable|numeric",
            "delivery_time_unit" => "nullable|regex:/^[آ-ی]+$/u",
            "amount" => "nullable|numeric",
            "status" => "required|in:0,1"
        ];
    }
}
