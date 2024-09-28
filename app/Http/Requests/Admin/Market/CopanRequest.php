<?php

namespace App\Http\Requests\Admin\Market;

use Illuminate\Foundation\Http\FormRequest;

class CopanRequest extends FormRequest
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
        if($this->isMethod('post'))
        {
            return [
                "code" => "required|regex:/^[A-z0-9]+$/|unique:copans,code",
                "amount" => "required|numeric",
                "amount_type" => "required|in:0,1",
                "discount_ceiling" => "required|numeric",
                "end_date" => "required|numeric",
                "start_date" => "required|numeric",
                "type" => "required|in:0,1",
                "status" => "required|in:0,1",
                "user_id" => "nullable|exists:users,id"
            ];

        }else{

            return [
                "code" => "required|regex:/^[A-z0-9]+$/|unique:copans,code," . $this->copan->id,
                "amount" => "required|numeric",
                "amount_type" => "required|in:0,1",
                "discount_ceiling" => "required|numeric",
                "end_date" => "required|numeric",
                "start_date" => "required|numeric",
                "type" => "required|in:0,1",
                "status" => "required|in:0,1",
                "user_id" => "nullable|exists:users,id"
            ];
            
        }
    }
}
