<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FilterTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => 'nullable|in:pending,in_progress,completed,overdue',
            'start_date' => 'required_with:end_date|date',
            'end_date' => 'required_with:start_date|date',
        ];
    }


}
