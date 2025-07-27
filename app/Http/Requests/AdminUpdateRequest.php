<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AdminUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::guard('admin')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => ['fillable', 'alpha_dash', 'min:6', 'max:200', 'unique:admins,username,'.$this->admin->id],
            'email'    => ['fillable', 'email', 'unique:admins,email,'.$this->admin->id],
            'disabled' => ['integer', 'min:0', 'max:1'],
        ];
    }
}
