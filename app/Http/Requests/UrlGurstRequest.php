<?php

namespace App\Http\Requests;

use App\Rules\UrlRule;
use Illuminate\Foundation\Http\FormRequest;

class UrlGurstRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "url" => ['required','url',new UrlRule],
        ];
    }

    function messages()
    {
        return [
            "url" => "Ссылка не валидна, запрещена или повторяется"
        ];
    }
}
