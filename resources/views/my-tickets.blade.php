<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Tiket Saya
        </h2>
    </x-slot>

    <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <h1 class="mb-6 text-2xl font-bold text-gray-900">Riwayat Pembelian Tiket</h1>

            @if(session('success'))
                <div class="p-4 mb-6 text-sm text-green-800 bg-green-100 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if($bookings->isEmpty())
                <div class="py-12 text-center">
                    <svg class="w-16 h-16 mx-auto mb-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                    </svg>
                    <p class="mb-4 text-gray-500">Kamu belum memiliki tiket seminar saat ini.</p>
                    <a href="{{ route('dashboard') }}" class="inline-block px-6 py-2 text-sm font-semibold text-white transition duration-150 ease-in-out bg-indigo-600 rounded-md shadow-lg hover:bg-indigo-500 shadow-indigo-500/30">
                        Cari Seminar Sekarang
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                    @foreach($bookings as $booking)
                        <div class="relative flex flex-col justify-between overflow-hidden transition duration-300 border border-gray-200 md:flex-row rounded-2xl bg-gray-50 hover:shadow-xl hover:shadow-indigo-500/10">
                            
                            <div class="flex-1 p-6 flex flex-col justify-between">
                                <div>
                                    <div class="mb-3">
                                        @if($booking->status === 'pending')
                                            <span class="px-2.5 py-0.5 text-xs font-semibold text-yellow-800 bg-yellow-100 rounded-full">Menunggu Verifikasi</span>
                                        @elseif($booking->status === 'approved')
                                            <span class="px-2.5 py-0.5 text-xs font-semibold text-green-800 bg-green-100 rounded-full">Terverifikasi</span>
                                        @else
                                            <span class="px-2.5 py-0.5 text-xs font-semibold text-red-800 bg-red-100 rounded-full">Ditolak</span>
                                        @endif
                                    </div>

                                    <p class="text-xs font-bold tracking-widest text-indigo-600 uppercase">{{ $booking->ticket_code }}</p>
                                    <h2 class="mt-1 text-xl font-bold text-gray-900 line-clamp-2 leading-tight">{{ $booking->event->title }}</h2>
                                </div>

                                <div class="pt-4 mt-6 space-y-1.5 text-xs text-gray-600 border-t border-gray-200">
                                    <div class="flex justify-between">
                                        <span>Nama Pengguna:</span>
                                        <span class="font-semibold text-gray-900">{{ Auth::user()->name }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Tanggal Pesan:</span>
                                        <span class="font-medium text-gray-900">{{ $booking->created_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Total Bayar:</span>
                                        <span class="font-bold text-indigo-600 text-sm">Rp {{ number_format($booking->total_price, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="hidden md:flex flex-col justify-between items-center py-2 w-1 relative">
                                <div class="w-4 h-4 bg-white border-b border-r border-gray-200 rounded-full -mt-4 -mr-4 transform rotate-45"></div>
                                <div class="h-full border-l-2 border-dashed border-gray-300 my-2"></div>
                                <div class="w-4 h-4 bg-white border-t border-l border-gray-200 rounded-full -mb-4 -ml-4 transform rotate-45"></div>
                            </div>

                            <div class="flex flex-col items-center justify-center p-6 bg-gray-100/70 border-t-2 border-dashed md:border-t-0 md:border-l border-gray-200 text-center md:w-44 min-w-[170px]">
                                <div class="p-2 bg-white rounded-xl border border-gray-200 shadow-sm">
                                    <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $booking->ticket_code }}" alt="QR Code" class="w-24 h-24">
                                </div>
                                <p class="text-[10px] font-mono text-gray-400 mt-2 tracking-widest">SCAN REGISTRASI</p>
                            </div>

                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
