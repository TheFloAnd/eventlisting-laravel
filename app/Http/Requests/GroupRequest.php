<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
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
            __('GruppenName') => 'required|max:100',
            __('GruppenAlias') => 'required|unique:App\Models\Groups,alias|max:100',
            __('GruppenFarbe') => 'required|max:7',
        ];
    }
}
