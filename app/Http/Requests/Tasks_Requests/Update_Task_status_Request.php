<?php

namespace App\Http\Requests\Tasks_Requests;

use Illuminate\Foundation\Http\FormRequest;

class Update_Task_status_Request extends FormRequest
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
            'status' => 'sometimes|nullable|string|in:Pending,Completed',
        ];
    }
    //===========================================================================================================================
    public function attributes(): array
    {
        return [
            'status' => 'حالة المهمة',
        ];
    }
    //===========================================================================================================================

    public function messages(): array
    {
        return [
            'string' => 'يحب أن يكون الحقل :attribute يحوي محارف',
            'in' => 'يجب أن يكون  :attribute إحدى الأنواع التالية : Pending أو Completed',
        ];
    }
}
