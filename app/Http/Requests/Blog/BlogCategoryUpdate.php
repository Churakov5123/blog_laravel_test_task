<?php

namespace App\Http\Requests\Blog;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Валидация запроса на редактирование категорий.
 *
 * Class BlogCategoryUpdate
 * @package App\Http\Requests\Blog
 */
class BlogCategoryUpdate extends FormRequest
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
            'parent_id' => 'required|integer|exists:blog_categories,id',
            'title' => 'required|min:5|max:250',
            'slug' => 'max:200',
            'description' => 'max:500',
        ];
    }
}
