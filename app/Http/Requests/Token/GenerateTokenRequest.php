<?php

namespace App\Http\Requests\Token;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class GenerateTokenRequest
 * @package App\Http\Requests\Token
 * @author Ahmed Helal Ahmed
 */
class GenerateTokenRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'email'       => 'required|email',
            'password'    => 'required|string',
            'device_name' => 'required',
        ];
    }
}
