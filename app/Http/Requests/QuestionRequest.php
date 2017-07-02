<?php

namespace App\Http\Requests;

use Gate;
use Auth;
use App\Http\Requests\Request;

class QuestionRequest extends Request
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
        return [
            'title' => 'required|min:5|max:255',
            'body' => 'required|min:10',
            'tags' => 'required|array|tags|max:5',
            'my_name' => 'bot',
        ];
    }
}
