<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class OrderRequest extends FormRequest
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
            case 'postCheckout': {
                    return [
                        'user_id' => 'required',
                        'name' => 'required|max:255',
                        'phone'=> 'required|regex:/(0)[0-9]{9}/|max:11',
                        'address' => 'required',
                        'note' => 'nullable',
                        'total' => 'required',
                    ];
                }
            case 'update': {
                    // Add a validation rule to exclude soft-deleted records

                    return [
                        'name' => [
                            'required',
                            'max:255'
                        ],
                        'slug' => [
                            'required',
                            'max:255'
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
            'user_id.required' => 'Vui lòng đăng nhập để tiếp tục',
            'name.required' => 'Tên người nhận không được để trống',
            'name.max' => 'Tên người nhận không được quá 255 ký tự',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'phone.max' => 'Số điện thoại không được quá 11 ký tự',
            'address.required' => 'Địa chỉ không được để trống',
            'total.required' => 'Tổng tiền không được để trống',
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
