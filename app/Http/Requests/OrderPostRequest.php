<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderPostRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'value' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'key',
        ];
    }
    /**
     * Apply custom error message
     */
    public function messages()
    {
        return [
            'name.required' => 'Key is required',
            'name.string' => 'Key is required as string',
            'name.max' => 'Key maximum length should not be greater than 255',
            'value.required' => 'Value is required',
        ];
    }
    /**
     * prepare the input data before validation
     */
    protected function prepareForValidation()
    {
        $collection = collect($this->request->all());
        $request_data = $collection->map( function ($item, $key) {
            return ['name' => $key, 'value' => $item, 'updated_at' => time()];
        })->first();
        if ($request_data) {
            $this->merge($request_data);
        }
        
    }
}
