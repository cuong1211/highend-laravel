<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class ProductTypeRequest extends FormRequest
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
                            'max:255',
                            Rule::unique('product_types', 'name')->whereNull('deleted_at'),
                        ],
                        'slug' => [
                            'required',
                            'max:255',
                            Rule::unique('product_types', 'slug')->whereNull('deleted_at'),
                        ],
                        'product_id' => 'nullable|exists:products,id',
                        'capacity' => 'required|max:255',
                        'color_id' => 'required|max:255',
                        'color_id.*' => 'required|not_in:0',
                        'color_price.*' => 'required|numeric|lt:99999999999',
                    ];
                }
            case 'update': {
                    return [
                        'name' => [
                            'required',
                            'max:255',
                            Rule::unique('product_types', 'name')->whereNull('deleted_at')->ignore($this->product_type),
                        ],
                        'slug' => [
                            'required',
                            'max:255',
                            Rule::unique('product_types', 'slug')->whereNull('deleted_at')->ignore($this->product_type),
                        ],
                        'product_id' => 'required|exists:products,id',
                        'capacity' => 'required|max:255',
                        'color_id' => 'required|max:255',
                        'color_id.*' => 'required |not_in:0',
                        'color_price.*' => 'required|numeric|lt:99999999999',
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
            'product_id.required' => 'Danh mục không được để trống',
            'product_id.exists' => 'Danh mục không tồn tại',
            'capacity.required' => 'Tên dung lượng không được để trống',
        ];
        if ($this->get('color_id') != null) {
            foreach ($this->get('color_id') as $key => $val) {
                // dd($key);
                $index = $key + 1;
                $messages['color_id.' . $key . '.required'] = 'Màu ' . $index . ' không được để trống';
                $messages['color_id.' . $key . '.exists'] = 'Màu ' . $index . ' không tồn tại';
                $messages['color_id.' . $key . '.not_in'] = 'Phải chọn màu ở dòng ' . $index . '';
                $messages['color_price.' . $key . '.required'] = 'Giá màu ' . $index . ' không được để trống';
                $messages['color_price.' . $key . '.numeric'] = 'Giá màu ' . $index . ' phải là số';
                $messages['color_price.' . $key . '.gt'] = 'Giá màu ' . $index . ' phải lớn hơn 0';
                $messages['color_price.' . $key . '.lt'] = 'Giá màu ' . $index . ' phải nhỏ hơn 99999999999';
            }
        } else {
            $messages['color_id.required'] = 'Màu không được để trống';
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
