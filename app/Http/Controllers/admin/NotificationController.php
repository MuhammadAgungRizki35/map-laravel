<?php

namespace App\Http\Controllers\admin;

use App\Models\Order;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    // Tampilkan daftar notifikasi
//     public function index()
// {
//     $notifications = Notification::latest()->get();

//     // Ambil informasi pesanan user yang sedang login (menghindari Collection)
//     $order = request()->user()->orders()->latest()->first() ?? null;

//     return view('admin.notif.index', compact('notifications', 'order'));
// }

public function index()
{
    $notifications = Notification::latest()->get();

    // Ambil semua pengguna yang telah melakukan pemesanan
    $orders = Order::has('user')->latest()->get();

    return view('admin.notif.index', compact('notifications', 'orders'));
}
    // Tampilkan form tambah notifikasi
    public function create()
    {
        return view('admin.notif.create');
    }

    // Simpan notifikasi baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        Notification::create($request->all());

        return redirect()->route('admin.notif.index')->with('success', 'Notifikasi berhasil ditambahkan.');
    }

    // Tampilkan detail notifikasi
    public function show(Notification $notif)
    {
        return view('admin.notif.show', compact('notif'));
    }

    // Tampilkan form edit notifikasi
    public function edit(Notification $notif)
    {
        return view('admin.notif.edit', compact('notif'));
    }

    // Update notifikasi
    public function update(Request $request, Notification $notif)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        $notif->update($request->all());

        return redirect()->route('admin.notif.index')->with('success', 'Notifikasi berhasil diperbarui.');
    }

    // Hapus notifikasi
    public function destroy(Notification $notif)
    {
        $notif->delete();

        return redirect()->route('admin.notif.index')->with('success', 'Notifikasi berhasil dihapus.');
    }
}
