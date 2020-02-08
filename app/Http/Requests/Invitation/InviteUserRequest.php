<?php

namespace App\Http\Requests\Invitation;

use App\Constants\AppConstants;
use Illuminate\Foundation\Http\FormRequest;

class InviteUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user() && auth()->user()->role == AppConstants::ROLE_ADMIN;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|min:5',
            'email' => 'required|email' ,
            'role' => 'required|in:' . join(',' , AppConstants::ROLES)
        ];
    }
}
