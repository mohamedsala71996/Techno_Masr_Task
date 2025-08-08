<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $adminId = $this->id;
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:admins,email' . ($adminId ? ",{$adminId}" : ''),
            'role' => ['required', 'string', 'exists:roles,name'],
        ];
        if ($this->isMethod('post')) {
            $rules['password'] = 'required|string|min:8|confirmed';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }
        return $rules;
    }
}
