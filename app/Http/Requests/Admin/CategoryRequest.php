<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $categoryId =  $this->id;
        $rules = [
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ];
        if ($this->isMethod('post')) {
            $rules['name'] .= '|unique:categories,name';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['name'] .= '|unique:categories,name,' . $categoryId;
        }
        return $rules;
    }
}
