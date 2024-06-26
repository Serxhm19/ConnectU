<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'name' => 'required',
            'user_id' => 'required',
            'category_id' => 'required',
            'location' => 'required',
            'description' => 'required',
            'more_information' => 'required',
            'start_date' => 'required',
            'end_date' => 'required'
        ];
    }
}
