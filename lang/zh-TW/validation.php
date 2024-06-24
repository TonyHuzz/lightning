<?php

use App\Rules\Address;

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages.
    |
    */

    'accepted' => '必須是接受',
    'accepted_if' => '當 :other 為 :value 時，欄位必須被接受',
    'active_url' => '不是有效的網址',
    'after' => ' 必須在 :date 之後',
    'after_or_equal' => '必須要等於 :date 或更晚',
    'alpha' => '只能以字母組成',
    'alpha_dash' => '只能以字母、數字及斜線組成',
    'alpha_num' => '只能以字母及數字組成',
    'array' => '必須為陣列',
    'ascii' => '欄位只能包含單位元組的字母數字字符和符號',
    'before' => '必須比 :date 早',
    'before_or_equal' => '必須要等於 :date 或更早',
    'between' => [
        'numeric' => '必須介於 :min 至 :max 之間',
        'file' => '必須介於 :min 至 :max KB 之間 ',
        'string' => '必須介於 :min 至 :max 個字元之間',
        'array' => '必須有 :min - :max 個元素',
    ],
    'boolean' => '必須為布林值',
    'can' => '欄位包含未授權的值',
    'confirmed' => '欄位輸入不一致',
    'current_password' => '密碼不正確',
    'date' => '不是有效的日期',
    'date_equals' => '必須等於 :date 的日期',
    'date_format' => '不符合 :format 的格式',
    'decimal' => '必須有 :decimal 位小數',
    'declined' => '必須是拒絕',
    'declined_if' => '當 :other 為 :value 時，必須是拒絕',
    'different' => '必須與 :other 不同',
    'digits' => '必須是 :digits 位數字',
    'digits_between' => '必須介於 :min 至 :max 位數字',
    'dimensions' => '圖片尺寸不正確',
    'distinct' => '已經存在',
    'doesnt_end_with' => '不得以以下之一結尾：:values',
    'doesnt_start_with' => '不得以以下之一開頭：:values',
    'email' => '必須是有效的電子郵件位址',
    'ends_with' => ' 欄位必須以以下之一結尾：:values',
    'enum' => '選擇的選項無效',
    'exists' => '選擇的選項無效',
    'file' => '必須是一個檔案',
    'filled' => '不能留空',
    'gt' => [
        'numeric' => '必須大於 :value',
        'file' => '必須大於 :value KB',
        'string' => '必須多於 :value 個字元',
        'array' => '必須多於 :value 個元素',
    ],
    'gte' => [
        'numeric' => '必須大於或等於 :value',
        'file' => '必須大於或等於 :value KB',
        'string' => '必須多於或等於 :value 個字元',
        'array' => '必須多於或等於 :value 個元素',
    ],
    'image' => '必須是一張圖片',
    'in' => '所選擇的選項無效',
    'in_array' => '沒有在 :other 中',
    'integer' => '必須是一個整數',
    'ip' => '必須是一個有效的 IP 位址',
    'ipv4' => '必須是一個有效的 IPv4 位址',
    'ipv6' => '必須是一個有效的 IPv6 位址',
    'json' => '必須是正確的 JSON 字串',
    'lowercase' => '必須是小寫',
    'lt' => [
        'numeric' => '必須小於 :value',
        'file' => '必須小於 :value KB',
        'string' => '必須少於 :value 個字元',
        'array' => '必須少於 :value 個元素',
    ],
    'lte' => [
        'numeric' => '必須小於或等於 :value',
        'file' => '必須小於或等於 :value KB',
        'string' => '必須少於或等於 :value 個字元',
        'array' => '必須少於或等於 :value 個元素',
    ],
    'mac_address' => '必須是一個有效的 MAC 地址',
    'max' => [
        'numeric' => '不能大於 :max',
        'file' => '不能大於 :max KB',
        'string' => '輸入上限：:max字',
        'array' => '最多有 :max 個元素',
    ],
    'max_digits' => '不得有超過 :max 位數字',
    'mimes' => '必須為 :values 的檔案',
    'mimetypes' => '必須為 :values 的檔案',
    'min' => [
        'numeric' => '不能小於 :min',
        'file' => '不能小於 :min KB',
        'string' => '不能小於 :min 個字元',
        'array' => '至少有 :min 個元素',
    ],
    'min_digits' => '必須至少有 :min 位數字',
    'missing' => '必須缺失',
    'missing_if' => '當 :other 為 :value 時，必須缺失',
    'missing_unless' => '除非 :other 為 :value，否則必須缺失',
    'missing_with' => '當 :values 存在時，必須缺失',
    'missing_with_all' => '當 :values 存在時，必須缺失',
    'multiple_of' => '必須是 :value 的倍數',
    'not_in' => '所選擇的選項無效',
    'not_regex' => '格式錯誤',
    'numeric' => '必須為一個數字',
    'password' => [
        'letters' => '必須包含至少一個字母',
        'mixed' => '必須包含至少一個大寫字母和一個小寫字母',
        'numbers' => '必須包含至少一個數字',
        'symbols' => '必須包含至少一個符號',
        'uncompromised' => '給定的值已出現在數據洩露中請選擇一個不同的值',
    ],
    'present' => '必須存在',
    'prohibited' => '欄位是禁止的',
    'prohibited_if' => '當 :other 為 :value 時， 欄位是禁止的',
    'prohibited_unless' => '除非 :other 在 :values 中，否則欄位是禁止的',
    'prohibits' => '欄位禁止 :other 出現',
    'regex' => '格式錯誤',
    'required' => '不能留空',
    'required_array_keys' => '必須包含以下項目：:values',
    'required_if' => '不能留空',
    'required_if_accepted' => '當 :other 被接受時， 欄位是必須的',
    'required_unless' => '不能留空',
    'required_with' => '當 :values 出現時不能留空',
    'required_with_all' => '當 :values 出現時不能為空',
    'required_without' => '當 :values 留空時欄位不能留空',
    'required_without_all' => '當 :values 都沒有時欄位不能留空',
    'same' => '與 :other 必須相同',
    'size' => [
        'numeric' => '大小必須是 :size',
        'file' => '大小必須是 :size KB',
        'string' => '必須是 :size 個字元',
        'array' => '必須是 :size 個元素',
    ],
    'starts_with' => '必須以以下之一開頭：:values',
    'string' => '必須是一個字串',
    'timezone' => '必須是一個正確的時區值',
    'unique' => '已存在',
    'uploaded' => '上傳失敗',
    'uppercase' => '必須是大寫',
    'url' => '格式錯誤',
    'ulid' => '必須是一個有效的 ULID',
    'uuid' => '必須是一個有效的 UUID',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention 'attribute.rule' to name the lines. This makes it quick to
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
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of 'email'. This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],
];
