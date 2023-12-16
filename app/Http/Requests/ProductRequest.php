<?php

namespace App\Http\Requests;

use App\Models\specification;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProductRequest extends FormRequest
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
                            Rule::unique('products')->whereNull('deleted_at'),
                            'max:255',
                        ],
                        'slug' => [
                            'required',
                            Rule::unique('products')->whereNull('deleted_at'),
                            'max:255',
                        ],
                        'type_id' => 'required|not_in:none|exists:types,id',
                        'description' => 'nullable',
                        'specification_name' => 'nullable|max:255',
                        'specification_name.*' => 'nullable|max:255',
                        'specification_label.*.*' => 'nullable|max:255',
                        'specification_value.*.*' => 'nullable|max:2048',
                        'preview' => 'nullable',
                    ];
                }
            case 'update': {
                    return [
                        'name' => [
                            'required',
                            Rule::unique('products')->whereNull('deleted_at')->ignore($this->product),
                            'max:255',
                        ],
                        'slug' => [
                            'required',
                            Rule::unique('products')->whereNull('deleted_at')->ignore($this->product),
                            'max:255',
                        ],
                        'type_id' => 'required|not_in:none|exists:types,id',
                        'description' => 'nullable',
                        'specification_name' => 'required|max:255',
                        'specification_name.*' => 'required|max:255',
                        'specification_label.*.*' => 'required|max:255',
                        'specification_value.*.*' => 'required|max:2048',
                        'preview' => 'nullable',
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
            'name.required' => 'Tên sản phẩm không được để trống',
            'name.unique' => 'Tên sản phẩm đã tồn tại',
            'name.max' => 'Tên sản phẩm không được quá 255 ký tự',
            'slug.required' => 'Slug không được để trống',
            'slug.unique' => 'Slug đã tồn tại',
            'slug.max' => 'Slug không được quá 255 ký tự',
            'type_id.required' => 'Loại sản phẩm không được để trống',
            'type_id.exists' => 'Loại sản phẩm không tồn tại',
            'type_id.not_in' => 'Vui lòng chọn loại sản phẩm',

        ];
        // dd($this->get('specification_name'));
        if ($this->get('specification_name') != null) {
            foreach ($this->get('specification_name') as $key => $val) {
                $index = $key + 1;
                $messages['specification_name.' . $key . '.required'] = 'Tên thông số ' . $index . ' không được để trống';
                $messages['specification_name.' . $key . '.max'] = 'Tên thông số ' . $index . ' không được quá 255 ký tự';
            }
        } else {
            $messages['specification_name.required'] = 'Thông số không được để trống';
        }
        // dd($this->get('specification_label'));
        if ($this->get('specification_label') != null) {
            foreach ($this->get('specification_label') as $key => $val) {
                foreach ($val as $key1 => $val1) {
                    $index_block = $key + 1;
                    $index_row = $key1 + 1;
                    $messages['specification_label.' . $key . '.' . $key1 . '.required'] = 'Nhãn thông số ' . $index_block . ' dòng ' . $index_row . ' không được để trống';
                    $messages['specification_label.' . $key . '.' . $key1 . '.max'] = 'Nhãn thông số ' . $index_block . '  dòng ' . $index_row . 'không được quá 255 ký tự';
                    $messages['specification_value.' . $key . '.' . $key1 . '.required'] = 'Giá trị thông số ' . $index_block . ' dòng ' . $index_row . ' không được để trống';
                    $messages['specification_value.' . $key . '.' . $key1 . '.max'] = 'Giá trị thông số ' . $index_block . ' dòng ' . $index_row . ' không được quá 2048 ký tự';
                }
            }
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
