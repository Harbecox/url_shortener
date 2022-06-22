<?php

namespace App\Http\Requests;

use App\Rules\AliasRule;
use App\Rules\GroupOwnerRule;
use Illuminate\Foundation\Http\FormRequest;

class UrlStoreRequest extends FormRequest
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
            "url" => ['required','url'],
            "alias" => [new AliasRule],
            "group_id" => [new GroupOwnerRule]
        ];
    }
}
