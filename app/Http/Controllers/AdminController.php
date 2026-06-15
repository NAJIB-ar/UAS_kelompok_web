<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Menampilkan halaman dashboard admin (List semua transaksi)
    public function dashboard()
    {
        // Mengambil semua data booking beserta relasi user dan event, diurutkan dari yang terbaru
        $bookings = Booking::with(['user', 'event'])->latest()->get();
        
        return view('admin.dashboard', compact('bookings'));
    }

    // Fungsi untuk menyetujui pembayaran
    public function approve($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Ubah status menjadi approved
        $booking->update(['status' => 'approved']);

        return back()->with('success', 'Pembayaran berhasil diverifikasi. Tiket telah diaktifkan.');
    }

    // Fungsi untuk menolak pembayaran (misal: bukti transfer palsu/tidak valid)
    public function reject($id)
    {
        $booking = Booking::findOrFail($id);
        
        // Ubah status menjadi rejected
        $booking->update(['status' => 'rejected']);

        // Mengembalikan kuota tiket ke tabel event karena pembelian dibatalkan
        $booking->event->increment('ticket_quantity', $booking->quantity_purchased);

        return back()->with('error', 'Pembayaran ditolak. Kuota tiket telah dikembalikan.');
    }
}