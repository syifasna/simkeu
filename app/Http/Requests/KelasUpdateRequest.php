<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KelasUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        $kelas = $this->route('kela') ?? $this->route('kelas');

        return [
            'nama_kelas' => [
                'required',
                'string',
                'max:50',
                Rule::unique('kelas', 'nama_kelas')->ignore($kelas),
            ],

            'tingkat' => [
                'required',
                'in:VII,VIII,IX',
            ],

            'wali_kelas' => [
                'nullable',
                'string',
                'max:100',
            ],

            'kapasitas' => [
                'required',
                'integer',
                'min:1',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.unique' => 'Nama kelas sudah digunakan.',
            'nama_kelas.max' => 'Nama kelas maksimal 50 karakter.',

            'tingkat.required' => 'Tingkat wajib dipilih.',
            'tingkat.in' => 'Tingkat harus VII, VIII, atau IX.',

            'wali_kelas.max' => 'Nama wali kelas maksimal 100 karakter.',

            'kapasitas.required' => 'Kapasitas wajib diisi.',
            'kapasitas.integer' => 'Kapasitas harus berupa angka.',
            'kapasitas.min' => 'Kapasitas minimal 1 siswa.',
        ];
    }
}
