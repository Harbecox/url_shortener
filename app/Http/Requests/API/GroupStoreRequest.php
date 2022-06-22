<?php

namespace App\Http\Requests\Api;

use App\Rules\AliasRule;
use App\Rules\GroupOwnerRule;
use Illuminate\Foundation\Http\FormRequest;

class GroupStoreRequest extends FormRequest
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
            "title" => ['required'],
            "alias" => ['min:4','max:10',new AliasRule],
            "is_active" => ['boolean'],
            "is_rotation" => ['boolean'],
        ];
    }
}
