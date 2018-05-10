<?php
namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreTourProgramsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'month' => 'required',
            'select_date' => 'required|date_format:'.config('app.date_format'),
            'medical_representative_name' => 'required',
            'area' => 'required',
            'work_with_manager' => 'required',
        ];
    }
}
