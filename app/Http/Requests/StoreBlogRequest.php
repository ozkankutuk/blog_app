<?php

namespace App\Http\Requests;

use App\Models\Blog;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreBlogRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('blog_create');
    }

    public function rules()
    {
        return [
            'category_id' => [
                'integer',
                'exists:categories,id',
                'required',
            ],
            'title' => [
                'string',
                'required',
            ],
            'content' => [
                'string',
                'nullable',
            ],
            'images' => [
                'array',
                'nullable',
            ],
            'images.*.id' => [
                'integer',
                'exists:media,id',
            ],
        ];
    }
}
