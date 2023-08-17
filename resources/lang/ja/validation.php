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

    'accepted' => ':attributeを承認してください。',
    'active_url' => ':attributeは有効なURLではありません。',
    'after' => ':attributeは:date以降の日付にしてください。',
    'after_or_equal' => ':attributeは:date以降または同日の日付にしてください。',
    'alpha' => ':attributeはアルファベットのみ使用できます。',
    'alpha_dash' => ':attributeは英数字とダッシュ、アンダースコアのみ使用できます。',
    'alpha_num' => ':attributeは英数字のみ使用できます。',
    'array' => ':attributeは配列である必要があります。',
    'before' => ':attributeは:dateより前の日付にしてください。',
    'before_or_equal' => ':attributeは:dateより前または同日の日付にしてください。',
    'between' => [
        'numeric' => ':attributeは:min から :max の間である必要があります。',
        'file' => ':attributeは:min から :max キロバイトの間である必要があります。',
        'string' => ':attributeは:min から :max 文字の間である必要があります。',
        'array' => ':attributeは:min から :max 個のアイテムを持つ必要があります。',
    ],
    'boolean' => ':attributeは真または偽である必要があります。',
    'confirmed' => ':attributeの確認が一致しません。',
    'date' => ':attributeは有効な日付ではありません。',
    'date_equals' => ':attributeは:dateと同じ日付である必要があります。',
    'date_format' => ':attributeは:format形式と一致しません。',
    'different' => ':attributeと:otherは異なる必要があります。',
    'digits' => ':attributeは:digits桁である必要があります。',
    'digits_between' => ':attributeは:min から :max 桁の間である必要があります。',
    'dimensions' => ':attributeは無効な画像サイズです。',
    'distinct' => ':attributeのフィールドに重複した値があります。',
    'email' => ':attributeは有効なメールアドレスである必要があります。',
    'ends_with' => ':attributeは以下のいずれかで終わる必要があります: :values。',
    'exists' => '選択された:attributeは無効です。',
    'file' => ':attributeはファイルである必要があります。',
    'filled' => ':attributeのフィールドに値を入力してください。',
    'gt' => [
        'numeric' => ':attributeは:value より大きい必要があります。',
        'file' => ':attributeは:value キロバイトより大きい必要があります。',
        'string' => ':attributeは:value 文字より多い必要があります。',
        'array' => ':attributeは:value 個以上のアイテムを持つ必要があります。',
    ],
    'gte' => [
        'numeric' => ':attributeは:value 以上である必要があります。',
        'file' => ':attributeは:value キロバイト以上である必要があります。',
        'string' => ':attributeは:value 文字以上である必要があります。',
        'array' => ':attributeは:value 個以上のアイテムを持つ必要があります。',
    ],
    'image' => ':attributeは画像である必要があります。',
    'in' => '選択された:attributeは無効です。',
    'in_array' => ':attributeのフィールドは:otherに存在しません。',
    'integer' => ':attributeは整数である必要があります。',
    'ip' => ':attributeは有効なIPアドレスである必要があります。',
    'ipv4' => ':attributeは有効なIPv4アドレスである必要があります。',
    'ipv6' => ':attributeは有効なIPv6アドレスである必要があります。',
    'json' => ':attributeは有効なJSON文字列である必要があります。',
    'lt' => [
        'numeric' => ':attributeは:value より小さい必要があります。',
        'file' => ':attributeは:value キロバイトより小さい必要があります。',
        'string' => ':attributeは:value 文字より少ない必要があります。',
        'array' => ':attributeは:value 個より少ないアイテムを持つ必要があります。',
    ],
    'lte' => [
        'numeric' => ':attributeは:value 以下である必要があります。',
        'file' => ':attributeは:value キロバイト以下である必要があります。',
        'string' => ':attributeは:value 文字以下である必要があります。',
        'array' => ':attributeは:value 個以下のアイテムを持つ必要があります。',
    ],
    'max' => [
        'numeric' => ':attributeは:max 以下である必要があります。',
        'file' => ':attributeは:max キロバイト以下である必要があります。',
        'string' => ':attributeは:max 文字以下である必要があります。',
        'array' => ':attributeは:max 個以下のアイテムを持つ必要があります。',
    ],
    'mimes' => ':attributeは:values タイプのファイルである必要があります。',
    'mimetypes' => ':attributeは:values タイプのファイルである必要があります。',
    'min' => [
        'numeric' => ':attributeは:min 以上である必要があります。',
        'file' => ':attributeは:min キロバイト以上である必要があります。',
        'string' => ':attributeは:min 文字以上である必要があります。',
        'array' => ':attributeは:min 個以上のアイテムを持つ必要があります。',
    ],
    'not_in' => '選択された:attributeは無効です。',
    'not_regex' => ':attributeの形式が無効です。',
    'numeric' => ':attributeは数値である必要があります。',
    'password' => 'パスワードが間違っています。',
    'present' => ':attributeのフィールドは存在する必要があります。',
    'regex' => ':attributeの形式が無効です。',
    'required' => ':attributeのフィールドは必須です。',
    'required_if' => ':otherが:valueの場合、:attributeのフィールドは必須です。',
    'required_unless' => ':otherが:valuesでない限り、:attributeのフィールドは必須です。',
    'required_with' => ':values が存在する場合、:attributeのフィールドは必須です。',
    'required_with_all' => ':values が存在する場合、:attributeのフィールドは必須です。',
    'required_without' => ':values が存在しない場合、:attributeのフィールドは必須です。',
    'required_without_all' => ':values がすべて存在しない場合、:attributeのフィールドは必須です。',
    'same' => ':attributeと:otherは一致する必要があります。',
    'size' => [
        'numeric' => ':attributeは:sizeである必要があります。',
        'file' => ':attributeは:size キロバイトである必要があります。',
        'string' => ':attributeは:size 文字である必要があります。',
        'array' => ':attributeは:size 個のアイテムを含む必要があります。',
    ],
    'starts_with' => ':attributeは以下のいずれかで始まる必要があります: :values。',
    'string' => ':attributeは文字列である必要があります。',
    'timezone' => ':attributeは有効なタイムゾーンである必要があります。',
    'unique' => ':attributeは既に存在します。',
    'uploaded' => ':attributeのアップロードに失敗しました。',
    'url' => ':attributeの形式が無効です。',
    'uuid' => ':attributeは有効なUUIDである必要があります。',

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

    'attributes' => [
    'item_name' => '商品名',
    'price' => '価格',
    'item_description' => '商品説明',
    'item_status' => '商品の状態',
    'item_image' => '商品画像',
    'full_name' => '氏名',
    'phone_number' => '電話番号',
    'postal_code' => '郵便番号',
    'address' => '住所',
],

];
