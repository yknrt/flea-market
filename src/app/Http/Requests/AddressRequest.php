<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'zip' => ['required', 'size:8'],
            'address' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'zip.required' => '郵便番号を入力してください',
            'zip.size' => 'ハイフンありの8文字で入力してください',
            'address.required' => '住所を入力してください'
        ];
    }

}
