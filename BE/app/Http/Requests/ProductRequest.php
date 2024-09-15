<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
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
        $add = [];
        $edit = [];

        $check = $this->route()->getActionMethod();
        switch ($this->method()):
            case 'POST':
                switch ($check):
                    case 'store':
                        $add = [
                            'name' => 'required|unique:products',
                            'description' => 'required',
                            'quantity' => 'required|numeric',
                            'image' => 'required',
                            'sold' => 'required',
                        ];
                        break;
                    case 'update':
                        $edit = [
                            'name' => ['required',Rule::unique('products')->ignore($this->id)],
                            'description' => 'required',
                            'quantity' => 'required|numeric',
                            'image' => 'required',
                            'sold' => 'required',
                        ];
                        break;
                endswitch;
                break;
        endswitch;
        return $check === 'store' ? $add : $edit;
    }
    public function messages()
    {
        return [
            'name.required' => 'Sản phẩm không được để trống!',
            'name.unique' => 'Sản phẩm đã tồn tại!',
            'description.required' => 'Mô tả không được để trống!',
            'quantity.required' => 'Số lượng không được để trống!',
            'quantity.numeric' => 'Số lượng không phải là chữ',
            'image.required' => 'Hình ảnh không được để trống!',
            'sold.required' => 'Đã bán không được để trống!',
            'price.required' => 'Giá không được để trống!',
        ];
    }

}
