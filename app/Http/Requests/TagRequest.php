<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagRequest extends FormRequest
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
            // 标签名不能为空
            'name' => 'sometimes|required|confirmed'
        ];
    }

    /**
     * 中文提示
     */

    public function messages(){
        return [
            'name.required'  => '标签名称不能为空',
        ];
    }
}
