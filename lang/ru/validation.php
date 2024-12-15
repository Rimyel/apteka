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

    'accepted' => 'Поле :attribute должно быть принято.',
    'accepted_if' => 'Поле :attribute должно быть принято, когда :other равно :value.',
    'active_url' => 'Поле :attribute должно быть действительным URL.',
    'after' => 'Поле :attribute должно быть датой после :date.',
    'after_or_equal' => 'Поле :attribute должно быть датой после или равной :date.',
    'alpha' => 'Поле :attribute должно содержать только буквы.',
    'alpha_dash' => 'Поле :attribute должно содержать только буквы, цифры, дефисы и подчеркивания.',
    'alpha_num' => 'Поле :attribute должно содержать только буквы и цифры.',
    'array' => 'Поле :attribute должно быть массивом.',
    'ascii' => 'Поле :attribute должно содержать только однобайтовые буквенно-цифровые символы и знаки.',
    'before' => 'Поле :attribute должно быть датой до :date.',
    'before_or_equal' => 'Поле :attribute должно быть датой до или равной :date.',
    'between' => [
        'array' => 'Поле :attribute должно содержать от :min до :max элементов.',
        'file' => 'Поле :attribute должно быть от :min до :max килобайт.',
        'numeric' => 'Поле :attribute должно быть между :min и :max.',
        'string' => 'Поле :attribute должно содержать от :min до :max символов.',
    ],
    'boolean' => 'Поле :attribute должно быть истинным или ложным.',
    'can' => 'Поле :attribute содержит несанкционированное значение.',
    'confirmed' => 'Подтверждение поля :attribute не совпадает.',
    'contains' => 'В поле :attribute отсутствует обязательное значение.',
    'current_password' => 'Пароль неверен.',
    'date' => 'Поле :attribute должно быть действительной датой.',
    'date_equals' => 'Поле :attribute должно быть датой, равной :date.',
    'date_format' => 'Поле :attribute должно соответствовать формату :format.',
    'integer_decimal_places' => ':attribute должен иметь десятичные знаки: decimal',
    'decimal' => 'Поле :attribute должно иметь :decimal десятичных знаков.',
    'declined' => 'Поле :attribute должно быть отклонено.',
    'declined_if' => 'Поле :attribute должно быть отклонено, когда :other равно :value.',
    'different' => 'Поля :attribute и :other должны быть разными.',
    'digits' => 'Поле :attribute должно содержать :digits цифр.',
    'digits_between' => 'Поле :attribute должно содержать от :min до :max цифр.',
    'dimensions' => 'У поля :attribute недопустимые размеры изображения.',
    'distinct' => 'В поле :attribute есть дублирующее значение.',
    'doesnt_end_with' => 'Поле :attribute не должно заканчиваться одним из следующих значений: :values.',
    'doesnt_start_with' => 'Поле :attribute не должно начинаться с одного из следующих значений: :values.',
    'email' => 'Поле :attribute должно быть действительным адресом электронной почты.',
    'end_withs' => ':attribut должен заканчиваться на одно из следующих значений: values',
    'enum' => ':attribut не является допустимым',
    'exists' => ':attribut не является допустимым',
    'file' => 'Поле :attribute должно быть файлом.',
    'filled' => 'Поле :attribute должно иметь значение.',
    'gt' => [
        'array' => 'Поле :attribute должно содержать более чем :value элементов.',
        'file' => 'Поле :attribute должно превышать :value килобайт.',
        'numeric' => 'Поле :attribute должно превышать :value.',
        'string' => 'Поле :attribute должно превышать :value символов.',
    ],
    'gte' => [
        'array' => 'Поле :attribute должно содержать :value элементов или более.',
        'file' => 'Поле :attribute должно превышать или равняться :value килобайтам.',
        'numeric' => 'Поле :attribute должно превышать или равняться :value.',
        'string' => 'Поле :attribute должно превышать или равняться :value символам.',
    ],
    'hex_color' => 'Поле :attribute должно быть действительным шестнадцатеричным цветом.',
    'image' => 'Поле :attribute должно быть изображением.',
    'in' => 'Выбранное значение :attribute недействительно.',
    'in_array' => 'Поле :attribute должно существовать в :other.',
    'integer' => 'Поле :attribute должно быть целым числом.',
    'ip' => 'Поле :attribute должно быть действительным IP-адресом.',
    'ipv4' => 'Поле :attribute должно быть действительным IPv4-адресом.',
    'ipv6' => 'Поле :attribute должно быть действительным IPv6-адресом.',
    'json' => 'Поле :attribute должно быть действительной строкой JSON.',
    'list' => 'Поле :attribute должно быть списком.',
    'lowercase' => 'Поле :attribute должно быть в нижнем регистре.',
    'lt' => [
        'array' => 'Поле :attribute должно содержать менее чем :value элементов.',
        'file' => 'Поле :attribute должно быть меньше чем :value килобайт.',
        'numeric' => 'Поле :attribute должно быть меньше чем :value.',
        'string' => 'Поле :attribute должно содержать менее чем :value символов.',
    ],
    'lte' => [
        'array' => 'Поле :attribute не должно содержать более чем :value элементов.',
        'file' => 'Поле :attribute должно быть меньше или равно :value килобайтам.',
        'numeric' => 'Поле :attribute должно быть меньше или равно :value.',
        'string' => 'Поле :attribute должно содержать меньше или равно :value символов.',
    ],
    'mac_address' => 'Поле :attribute должно быть действительным MAC-адресом.',
    'max' => [
        'array' => 'Поле :attribute не должно содержать более чем :max элементов.',
        'file' => 'Поле :attribute не должно превышать :max килобайт.',
        'numeric' => 'Поле :attribute не должно превышать :max.',
        'string' => 'Поле :attribute не должно превышать :max символов.',
    ],
    'max_digits' => 'В поле :attribute не должно быть более чем :max цифр.',
    'mimes' => 'Поле :attribute должно быть файлом типа: :values.',
    'mimetypes' => 'Поле :attribute должно быть файлом типа: :values.',
    'min' => [
        'array' => 'Поле :attribute должно содержать как минимум :min элементов.',
        'file' => 'Поле :attribute должно быть как минимум :min килобайт.',
        'numeric' => 'Поле :attribute должно быть как минимум :min.',
        'string' => 'Поле :attribute должно содержать как минимум :min символов.',
    ],
    'min_digits' => 'В поле :attribute должно быть как минимум :min цифр.',
    'missing' => 'Поле :attribute должно отсутствовать.',
    'missing_if' => 'Поле :attribute должно отсутствовать, когда :other равно :value.',
    'missing_unless' => 'Поле :attribute должно отсутствовать, если только :other не равно :value.',
    'missing_with' => 'Поле :attribute должно отсутствовать, когда присутствует значение из списка: :values.',
    'missing_with_all' => 'Поле :attribute должно отсутствовать, когда присутствуют все значения: :values.',
    'multiple_of' => 'Поле :attribute должно быть кратно значению: :value.',
    'not_in' => 'Выбранное значение для поля :attribute недействительно.',
    'not_regex' => 'Формат поля :attribute недействителен.',
    'numeric' => 'Поле :attribute должно быть числом.',
    'password' => [
    'letters' => 'Поле :attribute должно содержать как минимум одну букву.',
    'mixed' => 'Поле :attribute должно содержать как минимум одну заглавную и одну строчную букву.',
    'numbers' => 'Поле :attribute должно содержать как минимум одну цифру.',
    'symbols' => 'Поле :attribute должно содержать как минимум один символ.',
    'uncompromised' => 'Указанное значение :attribute появлялось в утечке данных. Пожалуйста, выберите другое значение :attribute.',
],
'present' => 'Поле :attribute должно присутствовать.',
'present_if' => 'Поле :attribute должно присутствовать, когда :other равно :value.',
'present_unless' => 'Поле :attribute должно присутствовать, если только :other не равно :value.',
'present_with' => 'Поле :attribute должно присутствовать, когда присутствует значение из списка: :values.',
'present_with_all' => 'Поле :attribute должно присутствовать, когда присутствуют все значения: :values.',
'prohibited' => 'Поле :attribute запрещено.',
'prohibited_if' => 'Поле :attribute запрещено, когда :other равно :value.',
'prohibited_unless' => 'Поле :attribute запрещено, если только :other не находится в значениях: :values.',
'prohibits' => 'Поле :attribute запрещает присутствие поля :other.',
'regex' => 'Формат поля :attribute недействителен.',
'required' => 'Поле :attribute обязательно для заполнения.',
'required_array_keys' => 'Поле :attribute должно содержать записи для: :values.',
'required_if' => 'Поле :attribute обязательно для заполнения, когда :other равно :value.',
'required_if_accepted' => 'Поле :attribute обязательно для заполнения, когда :other принято.',
'required_if_declined' => 'Поле :attribute обязательно для заполнения, когда :other отклонено.',
'required_unless' => 'Поле :attribute обязательно для заполнения, если только :other не находится в значениях: :values.',
'required_with' => 'Поле :attribute обязательно для заполнения, когда присутствует значение из списка: :values.',
'required_with_all' => 'Поле :attribute обязательно для заполнения, когда присутствуют все значения: :values.',
'required_without' => 'Поле :attribute обязательно для заполнения, когда отсутствует значение из списка: :values.',
'required_without_all' => 'Поле :attribute обязательно для заполнения, когда ни одно из значений: :values не присутствует.',
'same' => 'Поле :attribute должно совпадать с полем :other.',
'size' => [
    'array' => 'Поле :attribute должно содержать ровно :size элементов.',
    'file' => 'Размер файла в поле :attribute должен быть равен :size килобайтам.',
    'numeric' => 'Значение поля :attribute должно быть равно :size.',
    'string' => 'Длина строки в поле :attribute должна быть равна :size символам.',
],
'starts_with' => 'Поле :attribute должно начинаться с одного из следующих значений: :values.',
'string' => 'Поле :attribute должно быть строкой.',
'timezone' => 'Поле :attribute должно быть действительным часовым поясом.',
'unique' => ':attribute уже занят.',
'unuploaded'=>  ':attribut не удалось загрузить',
'invalid_url'=>  ':attribut должен быть действительным URL',
  // Добавьте другие переводы по мере необходимости


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
