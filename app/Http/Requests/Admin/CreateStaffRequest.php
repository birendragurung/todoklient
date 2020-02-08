<?php

namespace App\Http\Requests\Admin;

use App\Constants\AppConstants;
use Illuminate\Foundation\Http\FormRequest;

class CreateStaffRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth('api')->check() && auth('api')->user()->role == AppConstants::ROLE_ADMIN ;
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
            'role' => 'in:' . join(',' , AppConstants::ROLES)
        ];
    }
}
