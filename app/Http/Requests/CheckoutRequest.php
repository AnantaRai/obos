<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Request;

class CheckoutRequest extends FormRequest
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
            'email' => 'required | email',
            'name' => 'required',
            'address' => 'required',
            'street_name' => 'required',
            'payment_method' => 'required',
            'phone' => 'required | string | size:10 | regex:/^[0-9]+/',
            'name_on_card' => Request::instance()->payment_method == 'cod' ? 'nullable' : 'required',
        ];
    }
}
