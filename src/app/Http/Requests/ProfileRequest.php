<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class ProfileRequest extends FormRequest
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
            'image' => ['mimes:jpg,png'],
            'name' => ['required', 'max:20'],
            'zip' => ['required', 'size:8'],
            'address' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'image.mimes' => 'アップロードされたファイルは画像ファイルではありません',
            'name.required' => 'お名前を入力してください',
            'name:max' => 'お名前は20文字以内で入力してください',
            'zip.required' => '郵便番号を入力してください',
            'zip.size' => 'ハイフンありの8文字で入力してください',
            'address.required' => '住所を入力してください'
        ];
    }

}
