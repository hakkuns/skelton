<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class AddToCartRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'product' => ['required', 'integer'],
            'quantity' => ['required', 'integer']
        ];
    }
}
