<?php

namespace App\Http\Requests;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;

class ValidateTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|string|in:' . TaskStatus::enum(),
            'priority' => 'required|string|in:' . TaskPriority::enum(),
            'assigned_to' => 'nullable|numeric|exists:users,id',
            'project_id' => 'nullable|numeric|exists:projects,id'
        ];
    }


    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $current_task = $this->route()->parameter('task');

        $this->merge([
            'project_id' => $current_task->project_id ?? $this->input('project_id'),
            'assigned_to' => $current_task->assigned_to ?? $this->input('assigned_to'),
        ]);
    }
}
