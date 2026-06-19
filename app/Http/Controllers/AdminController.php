<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // halaman dashboard admin
    public function dashboard()
    {
        // Mengambil semua data booking
        $bookings = Booking::with(['user', 'event'])->latest()->get();
        
        return view('admin.dashboard', compact('bookings'));
    }

    // menyetujui pembayaran
    public function approve(int $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Ubah status approved
        $booking->update(['status' => 'approved']);

        return back()->with('success', 'Pembayaran berhasil diverifikasi. Tiket telah diaktifkan.');
    }

    // menolak pembayaran
    public function reject(int $id)
    {
        $booking = Booking::findOrFail($id);
        
        // Ubah status rejected
        $booking->update(['status' => 'rejected']);

        // Mengembalikan kuota tiket
        $booking->event->increment('ticket_quantity', $booking->quantity_purchased);

        return back()->with('error', 'Pembayaran ditolak. Kuota tiket telah dikembalikan.');
    }
}