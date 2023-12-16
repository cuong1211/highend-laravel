<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class TypeRequest extends FormRequest
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
    public function rules()
    {
        $arr = explode('@', $this->route()->getActionName());
        $action = $arr[1];
        switch ($action) {
            case 'store': {
                    return [
                        'name' => [
                            'required',
                            Rule::unique('types')->whereNull('deleted_at'),
                            'max:255',
                        ],
                        'slug' => [
                            'required',
                            Rule::unique('types')->whereNull('deleted_at'),
                            'max:255',
                        ],
                        'category_id' => 'required',
                    ];
                }
            case 'update': {
                    return [
                        'name' => [
                            'required',
                            'max:255',
                            Rule::unique('types', 'name')->whereNull('deleted_at')->ignore($this->type),
                        ],
                        'slug' => [
                            'required',
                            'max:255',
                            Rule::unique('types', 'slug')->whereNull('deleted_at')->ignore($this->type),
                        ],
                        'category_id' => 'required',
                    ];
                }
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên mặt hàng không được để trống',
            'name.unique' => 'Tên mặt hàng đã tồn tại',
            'name.max' => 'Tên mặt hàng không được quá 255 ký tự',
        ];
    }

    protected function failedValidation(Validator $validator)
    {

        $errors = $validator->errors()->all();
        throw new HttpResponseException(
            response()->json(
                [
                    'type' => res_type('error'),
                    'title' => res_title('validate_error'),
                    'content' => $errors,
                ],
            )
        );
    }
}
