<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
        if($this->isMethod("post")){
            return [
                "first_name" => "nullable|regex:/^[آ-یA-z0-9۰-۹ء-ي ]+$/u|max:250",
                "last_name" => "nullable|regex:/^[آ-یA-z0-9۰-۹ء-ي ]+$/u|max:250",
                "email" => "nullable|email|max:250|unique:users,email",
                "status" => "required|in:0,1",
                "national_code" => "nullable|melli_code|unique:users,national_code",
                "avatar" => "nullable|image|mimes:jpg,png,pjp,jfif,svg|max:4000",
                "mobile" => "nullable|iran_mobile|unique:users,mobile",
                "activation" => "required|in:0,1",
                "password" => ["required" , Password::min(8)->mixedCase()->numbers()->symbols()],
                "confirm_password" => "required|same:password",
            ];
        }else{
            return [
                "first_name" => "nullable|regex:/^[آ-یA-z0-9۰-۹ء-ي ]+$/u|max:250",
                "last_name" => "nullable|regex:/^[آ-یA-z0-9۰-۹ء-ي ]+$/u|max:250",
                "email" => "nullable|email|max:250|unique:users,email",
                "status" => "required|in:0,1",
                "national_code" => "nullable|melli_code|unique:users,national_code",
                "avatar" => "nullable|image|mimes:jpg,png,pjp,jfif,svg|max:4000",
                "mobile" => "nullable|iran_mobile|unique:users,mobile",
                "activation" => "required|in:0,1",
                "password" => ["nullable" , Password::min(8)->mixedCase()->numbers()->symbols()],
                "confirm_password" => "nullable|same:password",
            ];
        }
    }
}
