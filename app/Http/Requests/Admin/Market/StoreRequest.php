<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
        if($this->isMethod('post')){
            return [
                "marketable_number" => "required|numeric",
                "name_receiver" => "required|persian_alpha",
                "name_deliverer" => "required|persian_alpha",
                "description" => "nullable|persian_alpha"
            ];
        }else{
            return [
                "marketable_number" => "nullable|numeric",
                "sold_number" => "nullable|numeric",
                "frozen_number" => "nullable|numeric",
            ];
        }
    }
}
