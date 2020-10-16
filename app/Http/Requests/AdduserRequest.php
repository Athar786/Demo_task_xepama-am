<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\adduser;
use Tests\TestCase;
class AdduserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required|string',
            'number'=>'required|digits:10',
            'address'=>'required'

        ];
    }

    
}
