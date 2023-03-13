<?php

namespace App\Http\Requests\Demand;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UpdateRequest extends FormRequest
{
    public function prepareForValidation()
    {
        $this->merge([
            'date_estimated' => Carbon::now()->toDateTimeString(),
            'date_expected'  => Carbon::now()->toDateTimeString(),
            'file_document'  => 'arquivo-word',
            'created_by'     => auth()->user()->id
        ]);
    }
    
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
            'request_id' => 'required',
            'priority_id' => 'required',
            'system_id' => 'required',
            'created_by' => 'required',
            'developer_id' => 'sometimes',
            'title' => 'sometimes',
            'description' => 'sometimes',
            'comment' => 'sometimes',
            'date_estimated' => 'sometimes',
            'date_expected' => 'sometimes',
            'file_document' => 'sometimes',
            'status_id' => 'required',
        ];
    }

    /**
    * Get the error messages for the defined validation rules.*
    * @return array
    */
    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),
                'status' => true
        ], 422));
    }
}