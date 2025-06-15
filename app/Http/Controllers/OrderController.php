<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = $user->orders;

        $hargaList = [
            0 => 14000, 4 => 16500, 6 => 18000, 8 => 19500,
            10 => 21000, 12 => 22500, 14 => 24000, 16 => 25500,
            18 => 27000, 20 => 28500, 22 => 30000, 24 => 31500,
            26 => 33000, 28 => 34500, 30 => 36000
        ];

        return view('order.index', compact('orders', 'hargaList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'jumlah_pcs' => 'required|integer|min:1',
            'jumlah_plastik' => 'required|integer|min:0',
            'file_word' => 'required|mimes:doc,docx|max:5120', // validasi Word
        ]);

        $user = Auth::user();

        $hargaList = [
            0 => 14000, 4 => 16500, 6 => 18000, 8 => 19500,
            10 => 21000, 12 => 22500, 14 => 24000, 16 => 25500,
            18 => 27000, 20 => 28500, 22 => 30000, 24 => 31500,
            26 => 33000, 28 => 34500, 30 => 36000
        ];

        $jumlahPlastik = $request->jumlah_plastik;
        $jumlahPcs = $request->jumlah_pcs;

        $hargaPerPcs = $hargaList[$jumlahPlastik] ?? 0;
        $totalHarga = $hargaPerPcs * $jumlahPcs;

        $filePath = $request->file('file_word')->store('order', 'public');

        Order::create([
            'user_id' => $user->id,
            'jumlah_pcs' => $jumlahPcs,
            'jumlah_plastik' => $jumlahPlastik,
            'file_word' => $filePath, // simpan file word
        ]);

        return redirect()->route('account.memesan.index')
            ->with('success', 'Pemesanan berhasil!')
            ->with('show_receipt', true);
    }
}
