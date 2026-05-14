<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataLokasiRequest;
use App\Http\Requests\UpdateDataLokasiRequest;
use App\Services\DataLokasiService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DataLokasiController extends Controller
{
    public function __construct(
        protected DataLokasiService $dataLokasiService
    ) {}

    public function index(): View|RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $lokasi = $this->dataLokasiService->listForAccount((string) $account);

        return view('data-lokasi.index', [
            'lokasi' => $lokasi,
        ]);
    }

    public function create(): View|RedirectResponse
    {
        if (! billing_user('account')) {
            return redirect()->route('login');
        }

        return view('data-lokasi.create');
    }

    public function store(StoreDataLokasiRequest $request): RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $this->dataLokasiService->create((string) $account, $request->validated());

        return redirect()
            ->route('data-lokasi.index')
            ->with('success', 'Data lokasi berhasil ditambahkan.');
    }

    public function edit(string $id): View|RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $record = $this->dataLokasiService->findForAccount((string) $account, (int) $id);
        if ($record === null) {
            abort(404);
        }

        return view('data-lokasi.edit', [
            'lokasi' => $record,
        ]);
    }

    public function update(UpdateDataLokasiRequest $request, string $id): RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $updated = $this->dataLokasiService->update(
            (string) $account,
            (int) $id,
            $request->validated()
        );

        if (! $updated) {
            return redirect()
                ->route('data-lokasi.index')
                ->with('error', 'Data lokasi tidak ditemukan.');
        }

        return redirect()
            ->route('data-lokasi.index')
            ->with('success', 'Data lokasi berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $idInt = (int) $id;
        $pelanggan = $this->dataLokasiService->countActivePelanggan((string) $account, $idInt);
        if ($pelanggan > 0) {
            return redirect()
                ->route('data-lokasi.index')
                ->with('error', 'Lokasi tidak dapat dihapus karena masih memiliki pelanggan aktif.');
        }

        $deleted = $this->dataLokasiService->delete((string) $account, $idInt);
        if (! $deleted) {
            return redirect()
                ->route('data-lokasi.index')
                ->with('error', 'Data lokasi tidak ditemukan.');
        }

        return redirect()
            ->route('data-lokasi.index')
            ->with('success', 'Data lokasi berhasil dihapus.');
    }
}
