<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Panel Admin - Verifikasi Tiket
        </h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white p-6 rounded-lg shadow-md border border-gray-200">
            
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <h1 class="text-2xl font-bold mb-6 text-gray-800">Daftar Transaksi Masuk</h1>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="bg-gray-50 text-left text-gray-600 text-sm uppercase tracking-wider">
                            <th class="py-3 px-4 border-b">Tgl Pembelian</th>
                            <th class="py-3 px-4 border-b">Pembeli</th>
                            <th class="py-3 px-4 border-b">Event</th>
                            <th class="py-3 px-4 border-b">Total & Bukti</th>
                            <th class="py-3 px-4 border-b">Status</th>
                            <th class="py-3 px-4 border-b text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm">
                        @forelse($bookings as $booking)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="py-3 px-4 border-b">{{ $booking->created_at->format('d M Y H:i') }}</td>
                                <td class="py-3 px-4 border-b font-semibold">{{ $booking->user->name }}</td>
                                <td class="py-3 px-4 border-b">{{ $booking->event->title }}<br><span class="text-xs text-gray-500">Qty: {{ $booking->quantity_purchased }} tiket</span></td>
                                <td class="py-3 px-4 border-b">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}<br>
                                    @if($booking->payment_proof)
                                        <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank" class="text-blue-600 hover:underline text-xs">Lihat Bukti</a>
                                    @else
                                        <span class="text-xs text-gray-400">Tidak ada file</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b">
                                    @if($booking->status === 'pending')
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 text-xs rounded-full">Pending</span>
                                    @elseif($booking->status === 'approved')
                                        <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">Approved</span>
                                    @else
                                        <span class="px-2 py-1 bg-red-100 text-red-800 text-xs rounded-full">Rejected</span>
                                    @endif
                                </td>
                                <td class="py-3 px-4 border-b text-center space-x-2">
                                    @if($booking->status === 'pending')
                                        <form action="{{ route('admin.booking.approve', $booking->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-green-600 text-white px-3 py-1 rounded text-xs hover:bg-green-700">Terima</button>
                                        </form>
                                        <form action="{{ route('admin.booking.reject', $booking->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700" onclick="return confirm('Yakin ingin menolak tiket ini?')">Tolak</button>
                                        </form>
                                    @else
                                        <span class="text-xs text-gray-400 italic">Selesai</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-gray-500">Belum ada transaksi yang masuk.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>