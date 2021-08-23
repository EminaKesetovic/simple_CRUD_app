<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientRequest extends FormRequest
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
            'name' => 'max:250',
            'address' => 'required|max:250',
            'city_id' => 'required|exists:cities,id',
            'country_id' => 'required|exists:countries,id',
            'contacts.*.contact_type_id' => 'required|exists:contact_types,id',
            //This can not be this simple with many to many sync. I am not sending id form client_contacts table so i can exclude that one from unique search
            //'contacts.*.contact' => 'required|unique:client_contacts,contact'
        ];
    }
}
