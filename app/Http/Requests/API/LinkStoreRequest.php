<?php

namespace App\Http\Requests\API;

use App\Models\Alias;
use App\Rules\AliasRule;
use App\Rules\GroupOwnerRule;
use Illuminate\Foundation\Http\FormRequest;

class LinkStoreRequest extends FormRequest
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
            "url" => ['required'],
            "alias" => ['min:4','max:10',new AliasRule],
            "group_id" => ['nullable',new GroupOwnerRule("asd")],
        ];
    }
}
