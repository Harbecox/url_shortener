<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => ':attribute должен быть принят.',
    'accepted_if' => ':attribute должен быть принят, когда :other равно :value.',
    'active_url' => ':attribute не является допустимым URL.',
    'after' => ':attribute должен быть датой, следующей за :date.',
    'after_or_equal' => ':attribute должен быть датой после или равным ей :date.',
    'alpha' => ':attribute должен содержать только буквы.',
    'alpha_dash' => ':attribute должен содержать только буквы, цифры, дефисы и символы подчеркивания.',
    'alpha_num' => ':attribute должен содержать только буквы и цифры.',
    'array' => ':attribute должен быть массивом.',
    'before' => ':attribute должен быть датой до :date.',
    'before_or_equal' => ':attribute должен быть датой до или равной:date.',
    'between' => [
        'array' => ':attribute должен иметь элементы от :min до :max items.',
        'file' => ' :attribute должен быть между :min и :max kilobytes.',
        'numeric' => ':attribute должен быть между :min и :max.',
        'string' => ':attribute должен быть между :min и :max символами.',
    ],
    'boolean' => 'The :attribute должен быть true или false.',
    'confirmed' => 'Подтверждение:attribute не соответствует.',
    'current_password' => 'Пароль неверен.',
    'date' => ':attribute недопустимый формат даты.',
    'date_equals' => ':attribute должен быть датой, равной :date.',
    'date_format' => ':attribute не соответствует формату :format.',
    'declined' => ':attribute должен быть отклонен.',
    'declined_if' => 'The :attribute должен быть отклонен, если :other равно :value.',
    'different' => ':attribute и :other должны быть разными',
    'digits' => 'The :attribute должен быть :digits digits.',
    'digits_between' => ':attribute должен быть между цифрами :max digits.',
    'dimensions' => ':attribute имеет недопустимые размеры изображения.',
    'distinct' => ':attribute имеет повторяющееся значение.',
    'email' => ':attribute должен быть действительным адресом электронной почты.',
    'ends_with' => ':attribute должен заканчиваться одним из следующих::values.',
    'enum' => 'Выбранный :attribute недействителен.',
    'exists' => 'Выбранный :attribute недействителен.',
    'file' => ':attribute должен быть файлом.',
    'filled' => ':attribute должен иметь значение.',
    'gt' => [
        'array' => ':attribute должен иметь более :value элементов.',
        'file' => ':attribute должен быть больше :value kilobytes.',
        'numeric' => ':attribute должен быть больше :value.',
        'string' => 'The :attribute должен быть больше :value символов.',
    ],
    'gte' => [
        'array' => ':attribute должен иметь :value элементы или более.',
        'file' => ':attribute должен быть больше или равен :value kilobytes.',
        'numeric' => ':attribute должен быть больше или равен :value.',
        'string' => ':attribute должен быть больше или равен :value символам.',
    ],
    'image' => ':attribute должен быть изображением.',
    'in' => 'Выбранный:attribute недействителен.',
    'in_array' => ':attribute не существует в :other.',
    'integer' => ':attribute должен быть целым числом.',
    'ip' => ':attribute должен быть допустимым IP-адресом.',
    'ipv4' => ':attribute должен быть действительным адресом IPv4.',
    'ipv6' => ':attribute должен быть действительным адресом IPv6.',
    'json' => ':attribute должен быть допустимой строкой JSON.',
    'lt' => [
        'array' => ':attribute должен иметь меньше :value элементов.',
        'file' => 'Размер:attribute должен быть меньше :value kilobytes.',
        'numeric' => ':attribute должен быть меньше:value.',
        'string' => ':attribute должен быть меньше:value символов.',
    ],
    'lte' => [
        'array' => ':attribute не должен содержать более :value элементов.',
        'file' => ':attribute должен быть меньше или равен :value kilobytes.',
        'numeric' => ':attribute должен быть меньше или равен :value.',
        'string' => ':attribute должен быть меньше или равен:value символов.',
    ],
    'mac_address' => 'The :attribute must be a valid MAC address.',
    'max' => [
        'array' => ':attribute не должен иметь более :max items.',
        'file' => ':attribute не должен превышать :max kilobytes.',
        'numeric' => ':attribute не должен быть больше :max.',
        'string' => ':attribute не должен превышать :max символов.',
    ],
    'mimes' => ':attribute должен быть файлом типа: :values.',
    'mimetypes' => ':attribute должен быть файлом типа: :values.',
    'min' => [
        'array' => ':attribute должен быть не менее :min items.',
        'file' => 'Размер :attribute должен быть не менее :min kilobytes.',
        'numeric' => ':attribute должен быть не менее :min.',
        'string' => ':attribute должен быть не менее :min символов.',
    ],
    'multiple_of' => 'The :attribute must be a multiple of :value.',
    'not_in' => 'The selected :attribute is invalid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => ':attribute должен иметь числовое значение.',
    'password' => [
        'letters' => ':attribute должен содержать хотя бы одну букву.',
        'mixed' => ':attribute должен содержать как минимум одну прописную и одну строчную букву.',
        'numbers' => ':attribute должен содержать хотя бы одно числовое значение.',
        'symbols' => ':attribute должен содержать хотя бы один символ.',
        'uncompromised' => 'The given :attribute has appeared in a data leak. Please choose a different :attribute.',
    ],
    'present' => 'The :attribute field must be present.',
    'prohibited' => 'The :attribute field is prohibited.',
    'prohibited_if' => 'The :attribute field is prohibited when :other is :value.',
    'prohibited_unless' => 'The :attribute field is prohibited unless :other is in :values.',
    'prohibits' => 'The :attribute field prohibits :other from being present.',
    'regex' => 'The :attribute format is invalid.',
    'required' => 'The :attribute является обязательным.',
    'required_array_keys' => 'The :attribute field must contain entries for: :values.',
    'required_if' => 'The :attribute field is required when :other равен :value.',
    'required_unless' => 'The :attribute является обязательным, если соответствует :other одному из :values.',
    'required_with' => ':attribute обязательно, если :values присутствует.',
    'required_with_all' => ':attribute обязательно, когда :values присутствуют.',
    'required_without' => ':attribute является обязательным, если :values отсутствует.',
    'required_without_all' => ':attribute является обязательным, если ни одно :values не присутствует.',
    'same' => ':attribute и :other должны совпадать..',
    'size' => [
        'array' => ':attribute должен содержать :size items.',
        'file' => ':attribute должен быть :size kilobytes.',
        'numeric' => ':attribute должен быть :size.',
        'string' => ':attribute должен состоять из :size символов.',
    ],
    'starts_with' => ':attribute должен начинаться с одного из следующих::values.',
    'string' => ':attribute must be a string.',
    'timezone' => ':attribute должен быть валидным часовым поясом.',
    'unique' => ':attribute уже занят.',
    'uploaded' => 'Не удалось загрузить :attribute.',
    'url' => ':attribute должен быть действительным URL.',
    'uuid' => ':attribute должен быть допустимым UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
