<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataTipePembayaranRequest;
use App\Http\Requests\UpdateDataTipePembayaranRequest;
use App\Services\DataTipePembayaranService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DataTipePembayaranController extends Controller
{
    public function __construct(
        protected DataTipePembayaranService $dataTipePembayaranService
    ) {}

    public function index(): View|RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $accountStr = (string) $account;
        $rows = $this->dataTipePembayaranService->listForAccount($accountStr);

        return view('data-tipe-pembayaran.index', [
            'tipePembayaran' => $rows,
        ]);
    }

    public function create(): View|RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        return view('data-tipe-pembayaran.create', [
            'lokasiOptions' => $this->dataTipePembayaranService->lokasiOptions((string) $account),
        ]);
    }

    public function store(StoreDataTipePembayaranRequest $request): RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $this->dataTipePembayaranService->create((string) $account, $request->toServicePayload());

        return redirect()
            ->route('data-tipe-pembayaran.index')
            ->with('success', 'Data tipe pembayaran berhasil ditambahkan.');
    }

    public function edit(string $id): View|RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $record = $this->dataTipePembayaranService->findForAccount((string) $account, (int) $id);
        if ($record === null) {
            abort(404);
        }

        return view('data-tipe-pembayaran.edit', [
            'tipePembayaran' => $record,
            'lokasiOptions' => $this->dataTipePembayaranService->lokasiOptions((string) $account),
        ]);
    }

    public function update(UpdateDataTipePembayaranRequest $request, string $id): RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $idInt = (int) $id;
        $payload = $request->toServicePayload();
        $updated = $this->dataTipePembayaranService->update((string) $account, $idInt, $payload);

        if (! $updated) {
            return redirect()
                ->route('data-tipe-pembayaran.index')
                ->with('error', 'Data tipe pembayaran tidak ditemukan.');
        }

        $accountStr = (string) $account;
        $this->dataTipePembayaranService->syncPaketPelanggan(
            $accountStr,
            $idInt,
            $request->boolean('ubah_data_paket_pelanggan')
        );
        $this->dataTipePembayaranService->syncPaketPpnPelanggan(
            $accountStr,
            $idInt,
            $request->boolean('ubah_data_paket_ppn_pelanggan')
        );

        return redirect()
            ->route('data-tipe-pembayaran.index')
            ->with('success', 'Data tipe pembayaran berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $idInt = (int) $id;
        $pelanggan = $this->dataTipePembayaranService->countPelangganByTipe((string) $account, $idInt);
        if ($pelanggan > 0) {
            return redirect()
                ->route('data-tipe-pembayaran.index')
                ->with('error', 'Tipe pembayaran tidak dapat dihapus karena masih memiliki pelanggan aktif.');
        }

        $deleted = $this->dataTipePembayaranService->delete((string) $account, $idInt);
        if (! $deleted) {
            return redirect()
                ->route('data-tipe-pembayaran.index')
                ->with('error', 'Data tipe pembayaran tidak ditemukan.');
        }

        return redirect()
            ->route('data-tipe-pembayaran.index')
            ->with('success', 'Data tipe pembayaran berhasil dihapus.');
    }
}
