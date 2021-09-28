<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{

    //protected $redirect = '/login';
    
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
            'title' => 'sometimes|required',
            'priority' => 'sometimes|required',
            'state' => 'sometimes|required',
            'project_id' => 'sometimes|required',
            'user_id' => 'sometimes'
        ];
    }
}
