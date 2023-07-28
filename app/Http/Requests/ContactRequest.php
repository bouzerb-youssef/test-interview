<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'prenom' => 'required|string|regex:/^[a-zA-Z]+$/',
            'nom' => 'required|string|regex:/^[a-zA-Z]+$/',
            'e_mail' => 'required|email',
            'cle' => 'required|string|alpha_num',
            'code_postal' => 'nullable|numeric',
            'ville' => 'nullable|string|alpha',
            'organisation_id' => 'required|exists:organisations,id',
        ];
    }
}
