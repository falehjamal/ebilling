<?php

namespace App\Http\Requests;

use App\Enums\MetodeInsentif;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreDataLokasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return billing_user('account') !== null;
    }

    protected function prepareForValidation(): void
    {
        if ($this->input('metode_insentif') === '' || $this->input('metode_insentif') === null) {
            $this->merge([
                'metode_insentif' => null,
                'insentif_sales' => null,
            ]);
        }
    }

    /**
     * @return array<string, array<int, \Illuminate\Contracts\Validation\ValidationRule|string>|string>
     */
    public function rules(): array
    {
        return [
            'nama_lokasi' => ['required', 'string', 'max:50'],
            'alamat_lokasi' => ['required', 'string'],
            'tlp_lokasi' => ['required', 'string', 'max:50'],
            'group_wa' => ['nullable', 'string', 'max:50'],
            'metode_insentif' => [
                'nullable',
                Rule::in(array_map(static fn (MetodeInsentif $m) => $m->value, MetodeInsentif::cases())),
            ],
            'insentif_sales' => [
                'nullable',
                Rule::requiredIf(fn (): bool => filled($this->input('metode_insentif'))),
                'numeric',
            ],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'insentif_sales.required' => 'Insentif wajib diisi jika metode insentif dipilih.',
            'insentif_sales.numeric' => 'Insentif harus berupa angka.',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nama_lokasi' => 'nama lokasi',
            'alamat_lokasi' => 'alamat lokasi',
            'tlp_lokasi' => 'telepon',
            'group_wa' => 'ID grup',
            'metode_insentif' => 'metode insentif',
            'insentif_sales' => 'insentif',
        ];
    }
}
