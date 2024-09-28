<?php

namespace App\Http\Requests\Admin\Content;

use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
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
                "title" => "required|max:150|regex:/^[آ-یA-zء-ي _]+$/u",
                "tags" => "required|regex:/^[آ-ی, A-z۰-۹ء-ي]+$/u|max:250",
                "body" => "required|regex:/^[آ-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u",
                "summary" => "required|regex:/^[آ-یA-z_\-*)( 0-9?!.,:;]+$/u",
                "status" => "required|in:0,1",
                "commentable" => "required|in:0,1",
                "published_at" => "required|numeric",
                "category_id" => "required|exists:post_categories,id",
                "image" => "required|image|mimes:jpg,png,pjp,jfif,svg"
            ];
        }else{
            return [
                "title" => "required|max:150|regex:/^[آ-یA-zء-ي _]+$/u",
                "tags" => "required|regex:/^[آ-ی, A-z۰-۹ء-ي]+$/u|max:250",
                "body" => "required|regex:/^[آ-یa-zA-Z0-9\-۰-۹ء-ي.,><\/;\n\r& ]+$/u",
                "summary" => "required|regex:/^[آ-یA-z_\-*)( 0-9?!.,:;]+$/u",
                "status" => "required|in:0,1",
                "commentable" => "required|in:0,1",
                "published_at" => "required|numeric",
                "category_id" => "required|exists:post_categories,id",
                "image" => "nullable|image|mimes:jpg,png,pjp,jfif,svg"
            ];
        }
    }
}
