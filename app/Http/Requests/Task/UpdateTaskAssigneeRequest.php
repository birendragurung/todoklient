<?php

namespace App\Http\Requests\Task;

use App\Constants\DBConstants;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskAssigneeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return TRUE;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'assignee' => 'required|integer|exists:' . DBConstants::USERS . ',id' ,
        ];
    }
}
