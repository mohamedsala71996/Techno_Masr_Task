<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $id = $this->id;
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email' . ($id ? ",$id" : ''),
        ];
        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:6|confirmed';
        } else {
            $rules['password'] = 'nullable|string|min:6|confirmed';
        }
        $rules['profile_image'] = 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048';
        return $rules;
    }
}
