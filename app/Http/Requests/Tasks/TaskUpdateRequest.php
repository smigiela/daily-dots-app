<?php

namespace App\Http\Requests\Tasks;

use App\Enums\Tasks\TaskStatusEnum;
use App\Enums\Tasks\TaskTypesEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class TaskUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $task = $this->route('task');

        return Auth::check() && $task->user_id === Auth::id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required', 'string'],
            'description' => ['sometimes', 'string', 'nullable'],
            'status' => [Rule::enum(TaskStatusEnum::class)],
            'type' => [Rule::enum(TaskTypesEnum::class)],
            'status_change_date' => ['date_format:Y-m-d H:i:s', 'nullable'],
            'due_date' => ['date_format:Y-m-d H:i:s', 'nullable'],
            'start_time' => ['date_format:H:i:s', 'nullable'],
            'stop_time' => ['date_format:H:i:s', 'nullable'],
        ];
    }
}
