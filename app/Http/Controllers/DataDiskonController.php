<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDataDiskonRequest;
use App\Http\Requests\UpdateDataDiskonRequest;
use App\Services\DataDiskonService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class DataDiskonController extends Controller
{
    public function __construct(
        protected DataDiskonService $dataDiskonService
    ) {}

    public function index(): View|RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $accountStr = (string) $account;
        $rows = $this->dataDiskonService->listForAccount($accountStr);

        return view('data-diskon.index', [
            'diskon' => $rows,
        ]);
    }

    public function create(): View|RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        return view('data-diskon.create', [
            'pelangganOptions' => $this->dataDiskonService->pelangganOptions((string) $account),
        ]);
    }

    public function store(StoreDataDiskonRequest $request): RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $id = $this->dataDiskonService->create((string) $account, $request->toServicePayload());
        if ($id === 0) {
            return redirect()
                ->route('data-diskon.create')
                ->with('error', 'Pelanggan tidak ditemukan. Silakan pilih ulang.')
                ->withInput();
        }

        return redirect()
            ->route('data-diskon.index')
            ->with('success', 'Data diskon berhasil ditambahkan.');
    }

    public function edit(string $id): View|RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $accountStr = (string) $account;
        $record = $this->dataDiskonService->findForAccount($accountStr, (int) $id);
        if ($record === null) {
            abort(404);
        }

        return view('data-diskon.edit', [
            'diskon' => $record,
            'pelangganOptions' => $this->dataDiskonService->pelangganOptionsWithFallback(
                $accountStr,
                (int) $record->id_warga
            ),
        ]);
    }

    public function update(UpdateDataDiskonRequest $request, string $id): RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $idInt = (int) $id;
        $updated = $this->dataDiskonService->update((string) $account, $idInt, $request->toServicePayload());

        if (! $updated) {
            return redirect()
                ->route('data-diskon.index')
                ->with('error', 'Data diskon tidak ditemukan atau pelanggan tidak valid.');
        }

        return redirect()
            ->route('data-diskon.index')
            ->with('success', 'Data diskon berhasil diperbarui.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $account = billing_user('account');
        if (! $account) {
            return redirect()->route('login');
        }

        $deleted = $this->dataDiskonService->delete((string) $account, (int) $id);
        if (! $deleted) {
            return redirect()
                ->route('data-diskon.index')
                ->with('error', 'Data diskon tidak ditemukan.');
        }

        return redirect()
            ->route('data-diskon.index')
            ->with('success', 'Data diskon berhasil dihapus.');
    }
}
