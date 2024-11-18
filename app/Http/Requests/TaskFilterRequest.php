<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskFilterRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'status' => 'sometimes|in:pending,in_progress,completed,overdue',
            'start_date' => 'required_with:end_date|prohibited_unless:end_date,null|date_format:Y-m-d H:i:s',
            'end_date' => 'required_with:start_date|prohibited_unless:start_date,null|date_format:Y-m-d H:i:s',
        ];
    }

    public function validate(array $rules = [], ...$params)
    {
        if (!$this->has('status') && !($this->has('start_date') && $this->has('end_date'))) {
            throw \Illuminate\Validation\ValidationException::withMessages([
                'filter' => ['Either status or date range must be provided']
            ]);
        }

        return parent::validate($rules, ...$params);
    }
}
