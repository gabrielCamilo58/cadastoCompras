<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdatePedido extends FormRequest
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
        $id = $this->segment(2);
        return [
            'name' => 'required|min:3|max:255',
            'price' => 'required|numeric',
            'codBarras' => "required|min:5|unique:produtos,codBarras,{$id},id",
            'description' => 'nullable|min:3|max:255',
        ];
    }
}
