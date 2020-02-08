<?php

namespace App\Http\Requests\Admin;

use App\Constants\AppConstants;
use App\Constants\DBConstants;
use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            'title' => 'required|string|min:5|max:191' ,
            'description' => 'nullable|string' ,
            'assignee' => 'nullable|integer|exists:' . DBConstants::USERS . ',id' ,
            'state' => 'required|string|in:' . join(AppConstants::TASK_STATES)
        ];
    }
}
