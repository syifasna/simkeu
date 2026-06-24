<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SiswaStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_id' => [
                'required',
                'exists:kategoris,id',
            ],

            'kelas_id' => [
                'required',
                'exists:kelas,id',
            ],

            'nama_siswa' => [
                'required',
                'string',
                'max:100',
            ],

            'jenis_kelamin' => [
                'required',
                'in:L,P',
            ],

            'tanggal_lahir' => [
                'nullable',
                'date',
            ],

            'nis' => [
                'required',
                'string',
                'max:30',
                'unique:siswas,nis',
            ],

            'alamat' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'no_hp' => [
                'nullable',
                'string',
                'max:20',
            ],

            'nama_wali' => [
                'nullable',
                'string',
                'max:100',
            ],

            'no_hp_wali' => [
                'nullable',
                'string',
                'max:20',
            ],

            'status_aktif' => [
                'required',
                'boolean',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kelas_id.required' => 'Kelas wajib dipilih.',

            'nama_siswa.required' => 'Nama siswa wajib diisi.',

            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',

            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah digunakan.',

            'status_aktif.required' => 'Status siswa wajib dipilih.',
        ];
    }
}
