<?php

declare(strict_types=1);

namespace Lisettes\Account\Request;

use Hyperf\Validation\Request\FormRequest;

class Account extends FormRequest
{
    /**
     * 验证场景
     *
     * @var string[]
     */
    protected $scenes = [
        'update-info'     => ['nickname', 'avatar', 'wechat', 'qq', 'gender', 'birthday', 'signature', 'region'],
        'update-password' => ['old_password', 'password', 'password_confirmation']
    ];

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'nickname'       => ['string', 'max:50'],
            'avatar'         => ['alpha_dash', 'max:255'],
            'wechat'         => ['alpha_dash', 'max:30'],
            'qq'             => ['numeric', 'max:999999999', 'min:100000'],
            'gender'         => ['numeric', 'in:0,1,2'],
            'birthday'       => ['date'],
            'signature'      => ['string', 'max:255'],
            'region'         => ['array'],
            'region.*'       => ['alpha_dash', 'max:80'],
            'old_password'   => ['required', 'alpha_dash', 'min:6', 'max:30'],
            'password'       => ['required', 'alpha_dash', 'min:6', 'max:30'],
            'trade_password' => ['required', 'alpha_dash', 'min:6', 'max:30']
        ];
    }

    /**
     * @return array
     */
    public function attributes(): array
    {
        $result = [];
        foreach (array_keys(self::rules()) as $field) {
            $result[$field] = trans('account.fields.' . $field);
        }
        return $result;
    }

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
}
