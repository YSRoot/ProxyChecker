<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProxyCheckRequest extends FormRequest
{
    private const REGEX_IP_WITH_PORT = '/((25[0-5]|2[0-4]\d|[01]?\d\d?)\.){3}(25[0-5]|2[0-4]\d|[01]?\d\d?:[0-9]+)/';

    public function rules(): array
    {
        return [
            'body' => [
                'nullable',
                'required_without:file',
                'string',
                'regex:' . self::REGEX_IP_WITH_PORT,
            ],
            'file' => [
                'nullable',
                'required_without:body',
            ],
        ];
    }

    public function messages()
    {
        return array_merge(parent::messages(), [
            'regex' => 'Введеный прокси неккоректен',
        ]);
    }
}
