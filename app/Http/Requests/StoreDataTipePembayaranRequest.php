<?php

namespace App\Http\Requests;

use App\Enums\JenisTipePembayaran;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StoreDataTipePembayaranRequest extends FormRequest
{
    public function authorize(): bool
    {
        return billing_user('account') !== null;
    }

    protected function prepareForValidation(): void
    {
        if ($this->input('lokasi') === '') {
            $this->merge(['lokasi' => null]);
        }
    }

    /**
     * @return array<string, array<int, \Illuminate\Contracts\Validation\ValidationRule|string>|string>
     */
    public function rules(): array
    {
        return [
            'nama_tipe' => ['required', 'string', 'max:200'],
            'keterangan_tipe' => ['nullable', 'string', 'max:200'],
            'harga_tipe' => ['required', 'integer', 'min:0'],
            'jenis_tipe_pembayaran' => [
                'required',
                'string',
                Rule::in(array_map(static fn (JenisTipePembayaran $j) => $j->value, JenisTipePembayaran::cases())),
            ],
            'lokasi' => [
                'nullable',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    if ($value === null || $value === '') {
                        return;
                    }
                    $account = billing_user('account');
                    if (! $account) {
                        $fail('Akun tidak valid.');

                        return;
                    }
                    if (! is_numeric($value)) {
                        $fail('Lokasi tidak valid.');

                        return;
                    }
                    $conn = DB::connection('tenant');
                    if (! $conn->getSchemaBuilder()->hasTable('tb_lokasi')) {
                        $fail('Tabel lokasi tidak tersedia.');

                        return;
                    }
                    $exists = $conn->table('tb_lokasi')
                        ->where('account', $account)
                        ->where('id_lokasi', (int) $value)
                        ->exists();
                    if (! $exists) {
                        $fail('Lokasi yang dipilih tidak ditemukan.');
                    }
                },
            ],
            'profile' => ['nullable', 'string', 'max:50'],
            'tampilkan_paket_di_registrasi' => ['required', Rule::in(['Ya', 'Tidak'])],
            'filter_harga_lokasi' => ['required', Rule::in(['Ya', 'Tidak'])],
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'nama_tipe' => 'nama tipe',
            'keterangan_tipe' => 'keterangan tipe',
            'harga_tipe' => 'harga',
            'jenis_tipe_pembayaran' => 'jenis tipe pembayaran',
            'lokasi' => 'lokasi',
            'profile' => 'profile',
            'tampilkan_paket_di_registrasi' => 'tampilkan paket di registrasi',
            'filter_harga_lokasi' => 'filter harga lokasi',
        ];
    }

    /**
     * @return array<string, mixed>
     */
    public function toServicePayload(): array
    {
        $validated = $this->validated();
        $lokasi = $validated['lokasi'] ?? null;

        return [
            'nama_tipe' => $validated['nama_tipe'],
            'keterangan' => $validated['keterangan_tipe'] ?? null,
            'harga' => (int) $validated['harga_tipe'],
            'jns_tipe_pembayaran' => $validated['jenis_tipe_pembayaran'],
            'id_lokasi' => ($lokasi !== null && $lokasi !== '') ? (int) $lokasi : null,
            'profile' => $validated['profile'] ?? null,
            'registrasi' => $validated['tampilkan_paket_di_registrasi'],
            'filter_lokasi' => $validated['filter_harga_lokasi'],
        ];
    }
}
