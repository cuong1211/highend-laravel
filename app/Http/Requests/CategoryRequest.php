<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
        $arr = explode('@', $this->route()->getActionName());
        $action = $arr[1];
        switch ($action) {
            case 'store': {
                    return [
                        'name' => [
                            'required',
                            Rule::unique('categories')->whereNull('deleted_at'),
                            'max:255',
                        ],
                        'slug' => [
                            'required',
                            Rule::unique('categories')->whereNull('deleted_at'),
                            'max:255',
                        ],
                    ];
                }
            case 'update': {
                    // Add a validation rule to exclude soft-deleted records
                    return [
                        'name' => [
                            'required',
                            'max:255',
                            Rule::unique('categories', 'name')->whereNull('deleted_at')->ignore($this->category),
                        ],
                        'slug' => [
                            'required',
                            'max:255',
                            Rule::unique('categories', 'slug')->whereNull('deleted_at')->ignore($this->category),
                        ],
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
