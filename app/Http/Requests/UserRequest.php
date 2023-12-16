<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
            case 'postRegister': {
                    return [
                        'name' => ['required', 'max:255',],
                        'phone' => ['required', 'unique:users','min:10','numeric'],
                        'email' => ['required', 'email', 'unique:users', 'max:255'],
                        'password' => ['required', 'min:8', 'max:255'],
                        'password_confirmation' => ['required', 'same:password'],
                        'isAdmin' => ['required', 'boolean'],
                    ];
                }
            case 'store': {
                    return [
                        'name' => ['required', 'max:255',],
                        'email' => ['required', 'email', 'unique:users', 'max:255'],
                        'password' => ['required', 'min:8', 'max:255'],
                        'password_confirmation' => ['required', 'same:password'],
                        'phone' => ['nullable', 'unique:users', 'max:255'],
                        'isAdmin' => ['required', 'boolean'],
                    ];
                }
            case 'update': {
                    return [
                        'name' => ['required', 'max:255',],
                        'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($this->user)],
                        'password' => ['nullable', 'min:8', 'max:255'],
                        'password_confirmation' => ['nullable', 'same:password'],
                        'phone' => ['nullable', 'max:255', Rule::unique('users')->ignore($this->user)],
                        'isAdmin' => ['required', 'boolean'],
                    ];
                }
            default:
                break;
        }
    }

    public function messages()
    {
        $messages = [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được quá 255 ký tự',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại',
            'email.max' => 'Email không được quá 255 ký tự',
            'password.required' => 'Mật khẩu không được để trống',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự',
            'password.max' => 'Mật khẩu không được quá 255 ký tự',
            'password_confirmation.required' => 'Xác nhận mật khẩu không được để trống',
            'password_confirmation.same' => 'Xác nhận mật khẩu không đúng',
            'phone.required' => 'Số điện thoại không được để trống',
            'phone.unique' => 'Số điện thoại đã tồn tại',
            'phone.max' => 'Số điện thoại không được quá 11 số',
            'phone.min' => 'Số điện thoại không được dưới 10 số',
            'phone.regex' => 'Số điện thoại không đúng định dạng',
            'isAdmin.required' => 'Vai trò không được để trống',
            'isAdmin.boolean' => 'Vai trò không đúng định dạng',

        ];
        return $messages;
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
