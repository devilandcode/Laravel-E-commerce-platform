<?php

namespace App\Http\Requests\Admin\Users;

use App\Models\User\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property User $user
 */
class UpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,id,' . $this->user->id,
            'role' => ['required', 'string', Rule::in([
                User::ROLE_ADMIN,
                User::ROLE_USER,
            ])]
        ];
    }
}
