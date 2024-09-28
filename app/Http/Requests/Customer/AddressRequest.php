<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            "city_id" => "required|exists:cities,id",
            "province_id" => "required|exists:provinces,id",
            "postal_code" => "required|iran_postal_code|max:250",
            "address" => "required|address",
            "recipient_first_name" => "required_if:receiver,on,persian_alpha|max:250",
            "recipient_last_name" => "required_if:receiver,on,persian_alpha|max:250",
            "mobile" => "required_if:receiver,on,iran_mobile",
            "no" => "required|max:250|regex:/^[آ-یA-z0-9]+$/u",
            "unit" => "required|max:250|regex:/^[آ-یA-z0-9]+$/u"
        ];
    }
}
