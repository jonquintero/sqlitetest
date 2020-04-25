<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
         $id= $this->post;

        $rules = [
            'name'             => 'required|unique:posts,name,' . $id,
            'excerpt'          => 'nullable|max:250',
            'body'             => 'nullable',
            'status'           => 'required|in:DRAFT,PUBLISHED',            
        ];

        return $rules;
    }
}
