<?php


namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        /** @var User|null $user */
        $user = Auth::user();

        if (! $user) {
            abort(403);
        }

        $bookings = $user->bookings()->with('event')->get();
        return view('my-tickets', compact('bookings'));
    }

    // Memproses form pembelian tiket & upload bukti bayar
    public function store(Request $request, int $eventId)
    {
        $event = Event::findOrFail($eventId);

        // Validasi input user
        $request->validate([
            'quantity' => 'required|integer|min:1|max:' . $event->ticket_quantity,
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // upload file bukti pembayaran
        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        // Hitung total harga
        $totalPrice = $event->price * $request->quantity;

        // data booking baru
        Booking::create([
            'user_id' => Auth::id(),
            'event_id' => $event->id(),
            'ticket_code' => 'SEM-' . strtoupper(Str::random(8)), // Generate kode
            'quantity_purchased' => $request->quantity,
            'total_price' => $totalPrice,
            'payment_proof' => $path,
            'status' => 'pending', 
        ]);

        $event->decrement('ticket_quantity', $request->quantity);

        return redirect()->route('booking.index')->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi admin.');
    }
}