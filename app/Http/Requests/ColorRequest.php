<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;


class ColorRequest extends FormRequest
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
                        'product_id' => 'required|exists:products,id',
                        'label' => 'required|max:255',
                        'value' => 'required|max:255',
                        'image' => 'required',
                        'image.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp,jpg|max:2048',
                    ];
                }
            case 'update': {
                    return [
                        'product_id' => 'required|exists:products,id',
                        'label' => 'required|max:255',
                        'value' => 'required|max:255',
                        'image' => 'nullable',
                        'image.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp,jpg|max:2048',
                    ];
                }
            default:
                break;
        }
    }

    public function messages()
    {
        $messages = [];
        $messages = [

            'product_id.required' => 'Danh mục không được để trống',
            'product_id.exists' => 'Danh mục không tồn tại',
            'label.required' => 'Tên màu không được để trống',
            'label.max' => 'Tên màu không được quá 255 ký tự',
            'value.required' => 'Mã màu không được để trống',
            'value.max' => 'Mã màu không được quá 255 ký tự',
            
        ];
        if ($this->get('image') != null) {
            foreach ($this->get('image') as $key => $val) {
                $messages['image.' . $key . '.required'] = 'Hình ảnh màu không được để trống';
                $messages['image.' . $key . '.image'] = 'Hình ảnh màu phải là hình ảnh';
                $messages['image.' . $key . '.mimes'] = 'Hình ảnh màu phải có định dạng jpeg, png, jpg, gif, svg';
                $messages['image.' . $key . '.max'] = 'Hình ảnh màu không được quá 2048 ký tự';
            }
        } else {
            $messages['image.required'] = 'Hình ảnh màu không được để trống';
        }
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
