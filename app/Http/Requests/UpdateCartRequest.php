<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class UpdateCartRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'quantity' => ['required', 'integer']
        ];
    }
}
