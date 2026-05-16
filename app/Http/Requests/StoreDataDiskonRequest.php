<?php

namespace App\Http\Requests;

use App\Enums\MetodeDiskon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class StoreDataDiskonRequest extends FormRequest
{
    public function authorize(): bool
    {
        return billing_user('account') !== null;
    }

    /**
     * @return array<string, array<int, \Illuminate\Contracts\Validation\ValidationRule|string>|string>
     */
    public function rules(): array
    {
        $diskonRules = ['required', 'numeric', 'min:0'];
        if ($this->input('metode_diskon') === MetodeDiskon::Presentase->value) {
            $diskonRules[] = 'max:100';
        }

        return [
            'id_warga' => [
                'required',
                'integer',
                'min:1',
                function (string $attribute, mixed $value, \Closure $fail): void {
                    $account = billing_user('account');
                    if (! $account || ! is_numeric($value)) {
                        $fail('Pelanggan tidak valid.');

                        return;
                    }
                    $conn = DB::connection('tenant');
                    $tbWarga = 'tb_warga_'.$account;
                    if (! $conn->getSchemaBuilder()->hasTable($tbWarga)) {
                        $fail('Data pelanggan tidak tersedia.');

                        return;
                    }
                    $exists = $conn->table($tbWarga)
                        ->where('account', $account)
                        ->where('id_warga', (int) $value)
                        ->where('status', '1')
                        ->where('level', 'Pelanggan')
                        ->exists();
                    if (! $exists) {
                        $fail('Pelanggan yang dipilih tidak ditemukan atau tidak aktif.');
                    }
                },
            ],
            'nama_diskon' => ['required', 'string', 'max:200'],
            'metode_diskon' => [
                'required',
                'string',
                Rule::in(array_map(static fn (MetodeDiskon $m) => $m->value, MetodeDiskon::cases())),
            ],
            'diskon' => $diskonRules,
        ];
    }

    /**
     * @return array<string, string>
     */
    public function attributes(): array
    {
        return [
            'id_warga' => 'pelanggan',
            'nama_diskon' => 'nama diskon',
            'metode_diskon' => 'metode diskon',
            'diskon' => 'diskon',
        ];
    }

    /**
     * @return array{id_warga: int, nama_diskon: string, metode_diskon: string, diskon: float}
     */
    public function toServicePayload(): array
    {
        $validated = $this->validated();

        return [
            'id_warga' => (int) $validated['id_warga'],
            'nama_diskon' => $validated['nama_diskon'],
            'metode_diskon' => $validated['metode_diskon'],
            'diskon' => (float) $validated['diskon'],
        ];
    }
}
