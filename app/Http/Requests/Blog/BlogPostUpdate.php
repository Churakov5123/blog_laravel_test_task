<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Валижация запроса на редактирвоание/создание статей.
 *
 * Class BlogPostUpdate
 * @package App\Http\Requests\Blog
 */
class BlogPostUpdate extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; //false; - говорим что пользователь авторизован!
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'category_id' => 'required|integer|exists:blog_categories,id',
            'title' => 'required|min:5|max:250',
            'slug' => 'max:200',
            'description' => 'string|max:500|min:3',
            'content_raw' => 'string|max:3000|min:3',
            'user_id' => 'required|integer',
        ];
    }
}
