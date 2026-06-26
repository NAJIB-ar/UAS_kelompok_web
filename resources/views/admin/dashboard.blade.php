<!-- <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Panel Admin - Verifikasi Tiket
        </h2>
    </x-slot>

    <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
            
            @if(session('success'))
                <div class="p-4 mb-4 text-green-800 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="p-4 mb-4 text-red-800 bg-red-100 rounded">
                    {{ session('error') }}
                </div>
            @endif

            <h1 class="mb-6 text-2xl font-bold text-gray-800">Daftar Transaksi Masuk</h1>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="text-sm tracking-wider text-left text-gray-600 uppercase bg-gray-50">
                            <th class="px-4 py-3 border-b">Tgl Pembelian</th>
                            <th class="px-4 py-3 border-b">Pembeli</th>
                            <th class="px-4 py-3 border-b">Event</th>
                            <th class="px-4 py-3 border-b">Total & Bukti</th>
                            <th class="px-4 py-3 border-b">Status</th>
                            <th class="px-4 py-3 text-center border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @forelse($bookings as $booking)
                            <tr class="transition hover:bg-gray-50">
                                <td class="px-4 py-3 border-b">{{ $booking->created_at->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3 font-semibold border-b">{{ $booking->user->name }}</td>
                                <td class="px-4 py-3 border-b">
                                    Rp {{ number_format($booking->total_price, 0, ',', '.') }}<br>
                                    @if($booking->payment_proof)
                                        <a href="{{ asset('storage/' . $booking->payment_proof) }}" target="_blank" class="text-xs text-blue-600 hover:underline">Lihat Bukti</a>
                                    @else
                                        <span class="text-xs text-gray-400">Tidak ada file</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 border-b">
                                    @if($booking->status === 'pending')
                                        <span class="px-2 py-1 text-xs text-yellow-800 bg-yellow-100 rounded-full">Pending</span>
                                    @elseif($booking->status === 'approved')
                                        <span class="px-2 py-1 text-xs text-green-800 bg-green-100 rounded-full">Approved</span>
                                    @else
                                        <span class="px-2 py-1 text-xs text-red-800 bg-red-100 rounded-full">Rejected</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 space-x-2 text-center border-b">
                                    @if($booking->status === 'pending')
                                        <form action="{{ route('admin.booking.approve', $booking->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 text-xs text-white bg-green-600 rounded hover:bg-green-700">Terima</button>
                                        </form>
                                        <form action="{{ route('admin.booking.reject', $booking->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="px-3 py-1 text-xs text-white bg-red-600 rounded hover:bg-red-700" onclick="return confirm('Yakin ingin menolak tiket ini?')">Tolak</button>
                                        </form>
                                    @else
                                        <span class="text-xs italic text-gray-400">Selesai</span>
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
</x-app-layout> -->