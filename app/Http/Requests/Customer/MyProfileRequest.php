<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class MyProfileRequest extends FormRequest
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
            "first_name" => "sometimes|required|regex:/^[آ-یA-z0-9۰-۹ء-ي ]+$/u|max:250",
            "last_name" => "sometimes|required|regex:/^[آ-یA-z0-9۰-۹ء-ي ]+$/u|max:250",
            'email' => 'sometimes|email|unique:users,email,' . $this->user()->id,
            "national_code" => "sometimes|required|melli_code|unique:users,national_code," . $this->user()->id,
            "mobile" => "sometimes|required|iran_mobile|unique:users,mobile," . $this->user()->id,
        ];
    }
}
