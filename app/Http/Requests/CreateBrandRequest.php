<?php

namespace App\Http\Requests;

use App\Http\Requests\BaseFormRequest;

class CreateBrandRequest extends BaseFormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'unique:brands']
        ];
    }
}
