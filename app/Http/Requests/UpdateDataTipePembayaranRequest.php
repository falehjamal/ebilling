<?php

namespace App\Http\Requests;

class UpdateDataTipePembayaranRequest extends StoreDataTipePembayaranRequest
{
    /**
     * @return array<string, array<int, \Illuminate\Contracts\Validation\ValidationRule|string>|string>
     */
    public function rules(): array
    {
        return array_merge(parent::rules(), [
            'ubah_data_paket_pelanggan' => ['sometimes', 'boolean'],
            'ubah_data_paket_ppn_pelanggan' => ['sometimes', 'boolean'],
        ]);
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return array_merge(parent::attributes(), [
            'ubah_data_paket_pelanggan' => 'ubah data paket pelanggan',
            'ubah_data_paket_ppn_pelanggan' => 'ubah data paket PPN pelanggan',
        ]);
    }
}
