<?php

namespace App\Http\Requests\Tasks_Requests;

use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class Store_Task_Request extends FormRequest
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
            'title' => 'required|string|unique:tasks,title|min:4|max:50',
            'description' => 'required|string|min:20|max:255',
            'due_date' => 'required|date|after_or_equal:today',
            'status' => 'required|string|in:Pending,Completed',
        ];
    }
    public function attributes(): array
    {
        return [
            'title' => 'عنوان المهمة',
            'description' => 'وصف المهمة',
            'due_date' => 'تاريخ التسليم',
            'status' => 'حالة المهمة',
        ];
    }
    //===========================================================================================================================

    public function messages(): array
    {
        return [
            'required' => ' :attribute مطلوب',
            'string' => 'يحب أن يكون الحقل :attribute يحوي محارف',
            'unique' => ':attribute  موجود سابقاً , يجب أن يكون :attribute غير مكرر',
            'title.min' => 'الحد الأدنى لطول :attribute على الأقل هو 4 حرف',
            'title.max' => 'الحد الأقصى لطول  :attribute هو 50 حرف',
            'description.min' => 'الحد الأدنى لطول :attribute على الأقل هو 20 حرف',
            'description.max' => 'الحد الأقصى لطول  :attribute هو 255 حرف',
            'date' => 'يجب أن يكون الحقل :attribute تاريخاً',
            'after_or_equal' => 'يجب أن بكون :attribute بتاريخ اليوم و ما بعد',
            'in' => 'يجب أن يكون  :attribute إحدى الأنواع التالية : Pending أو Completed',
        ];
    }
}
