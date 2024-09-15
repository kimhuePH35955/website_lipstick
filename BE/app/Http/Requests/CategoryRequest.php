<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // Đặt lại thành true nếu bạn muốn cho phép tất cả các yêu cầu.
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $add = [];
        $edit = [];

        switch ($this->method()):
            case 'POST':
                $add = [
                    'name' => 'required|unique:categories',
                ];
                break;
            case 'PUT':
            case 'PATCH':
                $edit = [
                    'name' => ['required', Rule::unique('categories')->ignore($this->route('category'))],
                ];
                break;
        endswitch;

        return $this->route('category') ? $edit : $add;
    }

    public function messages()
    {
        return [
            'name.required' => 'Tên danh mục không được để trống!',
            'name.unique' => 'Tên danh mục đã tồn tại!',
        ];
    }
}
