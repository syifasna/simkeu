<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class KategoriStoreRequest extends FormRequest
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
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'nama_kategori' => [
                'required',
                'string',
                'max:100',
                'unique:kategoris,nama_kategori',
            ],

            'biaya_dasar' => [
                'required',
                'numeric',
                'min:0',
            ],

            'persentase_potongan' => [
                'nullable',
                'numeric',
                'min:0',
                'max:100',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'nama_kategori.required' => 'Nama kategori wajib diisi.',
            'nama_kategori.unique' => 'Nama kategori sudah digunakan.',
            'nama_kategori.max' => 'Nama kategori maksimal 100 karakter.',

            'biaya_dasar.required' => 'Biaya dasar wajib diisi.',
            'biaya_dasar.numeric' => 'Biaya dasar harus berupa angka.',
            'biaya_dasar.min' => 'Biaya dasar tidak boleh kurang dari 0.',

            'persentase_potongan.numeric' => 'Persentase potongan harus berupa angka.',
            'persentase_potongan.min' => 'Persentase potongan minimal 0%.',
            'persentase_potongan.max' => 'Persentase potongan maksimal 100%.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'biaya_dasar' => str_replace(',', '', $this->biaya_dasar),
            'persentase_potongan' => $this->persentase_potongan ?: 0,
        ]);
    }
}
