<?php

namespace App\Rules;

use App\Models\CheckUrlOkStatus;
use App\Models\ForbiddenWord;
use GuzzleHttp\Client;
use Illuminate\Contracts\Validation\Rule;

class UrlRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $words = ForbiddenWord::all();
        foreach ($words as $word){
            if(str_contains($value, $word->word)){
                return false;
            }
        }
        $check = CheckUrlOkStatus::query()->firstOrFail()->check;

        if($check){
            $client = new Client();
            try {
                $client->get($value);
                return true;
            }catch (\Exception $e){
                return false;
            }
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ссылка не валидна или запрещена.';
    }
}
