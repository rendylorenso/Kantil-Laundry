<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Voucher;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class VoucherController extends Controller
{
    /**
     * Show voucher page
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(): View
    {
        $user = Auth::user();
        // $vouchers = Voucher::all();
        $vouchers = Voucher::where('expired_at', '>', Carbon::now())
                        ->orWhereNull('expired_at') // jika tidak ada expired
                        ->get();

        return view('admin.voucher', compact('user', 'vouchers'));
    }

    /**
     * Add new voucher to database
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'discount_value' => ['required'],
            'point_need'     => ['required'],
            'details'       => ['required'],
            'expired_at'       => ['required'],
        ]);

        // Cek apakah potongan ada yang sama di database
        $voucherExists = Voucher::where('discount_value', $input['discount_value'])->exists();

        if ($voucherExists) {
            return redirect()->route('admin.vouchers.index')
                ->with('error', 'Voucher potongan ' . $input['discount_value'] . ' sudah ada');
        }

        // Masukkan potongan ke dalam tabel vouchers
        $voucher = new Voucher([
            'name'           => 'Potongan ' . number_format($input['discount_value'], 0, ',', '.'),
            'discount_value' => $input['discount_value'],
            'point_need'     => $input['point_need'],
            'details'     => $input['details'],
            'description'    => 'Mendapatkan potongan harga ' . number_format($input['discount_value'], 0, ',', '.') . ' dari total transaksi',
            'active_status'  => 1,
            'expired_at'     => $input['expired_at'],
        ]);
        $voucher->save();

        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Voucher baru berhasil ditambah!');
    }

    /**
     * Update voucher status
     *
     * @param  \App\Models\Voucher $voucher
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleStatus(Voucher $voucher): JsonResponse
    {
        $voucher->active_status = $voucher->active_status ? 0 : 1;
        $voucher->save();

        return response()->json();
    }

    /* ==========  UPDATE POINT NEED  ========== */
    public function update(Request $request, Voucher $voucher): RedirectResponse
    {
        $data = $request->validate([
            'discount_value' => ['required', 'numeric', 'min:0'],
            'point_need'     => ['required', 'integer', 'min:0'],
            'details'        => ['required', 'string'],
            'expired_at'        => ['required', 'datetime'],
        ]);

        $voucher->update([
            'discount_value' => $data['discount_value'],
            'point_need'     => $data['point_need'],
            'details'        => $data['details'],
            'name'           => 'Potongan ' . number_format($data['discount_value'], 0, ',', '.'),
            'description'    => 'Mendapatkan potongan harga ' . number_format($data['discount_value'], 0, ',', '.'),
            'expired_at'        => $data['expired_at'],
        ]);

        return redirect()->route('admin.vouchers.index')
                        ->with('success', 'Voucher berhasil diperbarui!');
    }

    public function destroy(Voucher $voucher): RedirectResponse
    {
        $voucher->delete();

        return redirect()->route('admin.vouchers.index')
            ->with('success', 'Voucher berhasil dihapus!');
    }
}
