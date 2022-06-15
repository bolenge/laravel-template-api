<?php

namespace App\Http\Requests;

class CreateArticleRequest extends ValidatorRequest
{
    /**
     * Returns the validation rules applied in the request
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'body' => 'required|string',
            'official_date' => 'nullable',
            'cover' => 'nullable'
        ];
    }
}
