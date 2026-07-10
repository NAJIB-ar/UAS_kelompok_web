<x-app-layout>
    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="mb-2 text-3xl font-extrabold text-ink">Tiket Saya</h1>
            <p class="text-sm text-gray-500">Kelola dan lihat riwayat pembelian tiket seminarmu.</p>
        </div>

        @if(session('success'))
            <div class="flex gap-2 items-center p-4 mb-6 text-sm font-semibold rounded-xl border text-success bg-success-tint border-success/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                {{ session('success') }}
            </div>
        @endif

        @php
            $all = $bookings->count();
            $approved = $bookings->where('status', 'approved')->count();
            $rejected = $bookings->where('status', 'rejected')->count();
            $pending = $bookings->where('status', 'pending')->count();
        @endphp

        @if($bookings->isEmpty())
            <div class="py-16 text-center bg-white rounded-2xl border shadow-sm border-border">
                <svg class="mx-auto mb-4 w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z"></path>
                </svg>
                <h3 class="mb-2 text-lg font-bold text-ink">Belum ada tiket</h3>
                <p class="mb-6 text-sm text-gray-500">Kamu belum memiliki tiket seminar saat ini.</p>
                <a href="{{ route('dashboard') }}" class="inline-block px-6 py-3 text-sm font-bold text-white rounded-xl shadow-sm transition bg-primary hover:bg-primary-dark">
                    Cari Seminar Sekarang
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 gap-6 mb-8 lg:grid-cols-2">
                @foreach($bookings as $booking)
                    @php
                        $statusColor = 'border-gray-300';
                        $badgeClass = 'bg-gray-100 text-gray-600';
                        $statusText = 'Menunggu';
                        
                        if($booking->status === 'approved') {
                            $statusColor = 'border-success';
                            $badgeClass = 'bg-success-tint text-success';
                            $statusText = 'Terverifikasi';
                        } elseif($booking->status === 'rejected') {
                            $statusColor = 'border-danger';
                            $badgeClass = 'bg-danger-tint text-danger';
                            $statusText = 'Ditolak';
                        } elseif($booking->status === 'pending') {
                            $statusColor = 'border-yellow-400';
                            $badgeClass = 'bg-warning-tint text-yellow-700';
                            $statusText = 'Menunggu';
                        }
                    @endphp

                    <div class="flex flex-row justify-between bg-white border-y border-r border-border border-l-4 {{ $statusColor }} shadow-sm rounded-2xl p-6 transition hover:shadow-md">
                        
                        <div class="flex flex-col flex-1 pr-4">
                            <div class="mb-4">
                                <span class="inline-flex px-3 py-1 text-[11px] font-bold rounded-full {{ $badgeClass }}">
                                    {{ $statusText }}
                                </span>
                            </div>

                            <p class="text-[13px] font-bold text-primary font-mono mb-1">{{ $booking->ticket_code }}</p>
                            <h2 class="mb-8 text-xl font-bold leading-tight text-ink line-clamp-2">{{ $booking->event->title }}</h2>

                            <div class="flex flex-col gap-2 mt-auto">
                                <div class="flex justify-between items-center text-[13px]">
                                    <span class="text-gray-500">Nama Pengguna</span>
                                    <span class="font-bold text-ink">{{ Auth::user()->name }}</span>
                                </div>
                                <div class="flex justify-between items-center text-[13px]">
                                    <span class="text-gray-500">Tanggal Pesan</span>
                                    <span class="font-bold text-ink">{{ $booking->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-[13px]">
                                    <span class="text-gray-500">Total Bayar</span>
                                    <span class="font-mono font-bold text-primary">
                                        {{ $booking->total_price == 0 ? 'Rp 0' : 'Rp ' . number_format($booking->total_price, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col items-center justify-center shrink-0 w-[110px]">
                            <img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100&data={{ $booking->ticket_code }}" alt="QR Code" class="w-[88px] h-[88px] mb-2">
                            <p class="text-[9px] font-bold font-mono text-gray-500 tracking-widest text-center w-full uppercase">Scan Registrasi</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Informational Banner -->
            <div class="flex gap-4 items-start p-5 rounded-2xl border bg-primary-tint border-primary/5">
                <div class="mt-0.5 shrink-0">
                    <div class="flex justify-center items-center w-6 h-6 text-xs font-bold rounded-full border border-primary text-primary">i</div>
                </div>
                <div>
                    <h4 class="mb-1 text-sm font-bold text-ink">Informasi</h4>
                    <p class="text-sm text-gray-600">Tunjukkan QR Code saat registrasi ulang untuk memudahkan proses check-in seminar.</p>
                </div>
            </div>
        @endif
    </div>
    
        <!-- Footer -->
    <footer class="py-12 mt-12 text-white border-t bg-secondary border-white/10">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 justify-items-center md:grid-cols-3">
                <div class="md:col-span-1">
                    <div class="flex gap-2 items-center mb-4">
                        <div class="flex justify-center items-center w-8 h-8 rounded-md bg-primary">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                        </div>
                        <span class="text-xl font-extrabold tracking-tight">Academic Seminar</span>
                    </div>
                    <p class="mb-6 text-sm leading-relaxed text-gray-400">
                        Platform direktori dan pemesanan tiket seminar akademik terbaik di Indonesia.
                    </p>
                </div>
                
                <div>
                    <h4 class="mb-4 text-lg font-bold">Kontak</h4>
                    <ul class="space-y-2 text-sm text-gray-400">
                        <li><a href="#" class="transition hover:text-accent">FAQ</a></li>
                        <li><a href="#" class="transition hover:text-accent">Hubungi Kami</a></li>
                        <li><a href="#" class="transition hover:text-accent">Bantuan</a></li>
                    </ul>
                </div>
                
                <div>
                    <h4 class="mb-4 text-lg font-bold">Sosial Media</h4>
                    <div class="flex gap-4">
                        <a href="#" class="flex justify-center items-center w-10 h-10 text-white rounded-full transition bg-white/10 hover:bg-primary">
                            <span class="sr-only">Facebook</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" /></svg>
                        </a>
                        <a href="#" class="flex justify-center items-center w-10 h-10 text-white rounded-full transition bg-white/10 hover:bg-primary">
                            <span class="sr-only">Twitter</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" /></svg>
                        </a>
                        <a href="#" class="flex justify-center items-center w-10 h-10 text-white rounded-full transition bg-white/10 hover:bg-primary">
                            <span class="sr-only">Instagram</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z" /></svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="pt-8 mt-8 text-sm text-center text-gray-500 border-t border-white/10">
                &copy; {{ date('Y') }} Academic Seminar. All rights reserved.
            </div>
        </div>
    </footer>
</x-app-layout>