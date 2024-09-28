<?php

namespace App\Http\Requests\Admin\User;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        if($this->isMethod("post"))
        {
            return [
                'name' => "required|regex:/^[A-z0-9\-]+$/u|max:250",
                "description" => "required|persian_alpha",
                "permission_id" => "required"
            ];
        }else{
            $currentRoute = explode( '.' , Route::currentRouteName())[3];
            if($currentRoute == "update"){
                return [
                    'name' => "required|regex:/^[A-z0-9\-]+$/u|max:250",
                    "description" => "required|persian_alpha"
                ];
            }else{
                return[
                    "permission_id" => "required"
                ];
            }
        }
    }
}
