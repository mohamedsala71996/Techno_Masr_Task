<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $roleId = $this->id;
        $rules = [
            'name' => 'required|string|unique:roles,name' . ($roleId ? ',' . $roleId : ''),
            'permissions' => 'array',
        ];
        return $rules;
    }
}
