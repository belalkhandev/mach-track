<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MachineUpdateRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_id' => 'required',
            'machine_number' => 'required|unique:machines,machine_number,'.$this->route('machineId'),
            'local_number' => 'nullable|unique:machines,local_number,'.$this->route('machineId'),
            'transmission_type' => 'required',
            'floor_id' => 'required',
            'status' => 'required',
        ];
    }
}
