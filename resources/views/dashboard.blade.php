<x-app-layout>
    <!-- Hero Section -->
    <div class="overflow-hidden relative px-4 py-16 bg-secondary sm:px-6 lg:px-8">
        <div class="flex flex-col gap-10 justify-between items-center mx-auto max-w-7xl md:flex-row">
            <div class="z-10 w-full md:w-1/2">
                <h1 class="mb-4 text-4xl font-extrabold leading-tight text-white md:text-5xl">
                    Temukan Seminar Terbaik untuk <br/><span class="text-accent">Pengembangan Diri</span>
                </h1>
                <p class="mb-8 max-w-md text-lg text-gray-300">
                    Bergabunglah dalam seminar inspiratif bersama pembicara profesional dan tingkatkan skill Anda.
                </p>
                
            </div>
            
            <div class="flex relative z-10 justify-end w-full md:w-1/2">
                <div class="flex overflow-hidden relative justify-center items-center w-full max-w-lg h-64 rounded-2xl border shadow-2xl md:h-80 bg-secondary-deep border-white/10">
                    <div class="absolute top-10 left-10 w-32 h-32 rounded-full opacity-30 blur-3xl bg-primary"></div>
                    <div class="absolute right-10 bottom-10 w-32 h-32 rounded-full opacity-20 blur-3xl bg-accent"></div>
                    
                    <div class="flex flex-col items-center">
                        <svg class="mb-4 w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                        </svg>
                        <img src="{{ asset('images/seminar.jpg') }}" class="object-cover w-full h-full">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="px-4 py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between items-center pb-4 mb-8 border-b border-border">
            <h2 class="text-xl font-bold tracking-wider uppercase text-ink">Event Untuk Pengembangan Dirimu</h2>
        </div>
        
        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-2">
            @forelse($events as $event)
                <div class="flex overflow-hidden flex-row bg-white rounded-2xl border shadow-sm transition duration-200 border-border hover:-translate-y-1 hover:shadow-lg">
                    <div class="flex flex-col flex-1 justify-between p-6">
                        <div>
                            <div class="inline-block px-3 py-1 mb-3 text-xs font-bold rounded-md text-primary bg-primary-tint">
                                {{ $event->category }}
                            </div>
                            <h3 class="mb-2 text-lg font-bold leading-snug text-ink line-clamp-2">{{ $event->title }}</h3>
                            
                            <div class="mb-4 space-y-1.5">
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="mr-2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M, H:i') }}
                                </div>
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="mr-2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                                    {{ $event->speaker }}
                                </div>
                                <div class="flex items-center text-sm text-gray-700">
                                    <svg class="mr-2 w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    {{ $event->location }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex justify-between items-center pt-4 mt-auto border-t border-border">
                            <div>
                                @if($event->price == 0)
                                    <span class="font-bold text-success">GRATIS</span>
                                @else
                                    <span class="font-bold text-ink">Rp {{ number_format($event->price, 0, ',', '.') }}</span>
                                @endif
                            </div>
                            <a href="{{ route('event.show', $event->id) }}" class="px-5 py-2 text-sm font-bold text-white rounded-lg transition bg-primary hover:bg-primary-dark">
                                Lihat Detail
                            </a>
                        </div>
                    </div>
                    
                    <!-- Right Image Placeholder -->
                    <div class="flex overflow-hidden relative justify-center items-center m-3 w-2/5 rounded-xl bg-secondary-deep">
                        @if($event->image)
                            <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="object-cover absolute inset-0 w-full h-full">
                        @else
                            <div class="absolute w-20 h-20 rounded-full opacity-30 blur-xl bg-primary"></div>
                            <svg class="z-10 w-10 h-10 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-1 p-12 text-center bg-white rounded-2xl border shadow-sm md:col-span-2 border-border">
                    <svg class="mx-auto mb-4 w-16 h-16 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <h3 class="mb-1 text-lg font-bold text-ink">Belum ada seminar</h3>
                    <p class="text-gray-500">Maaf, belum ada pilihan seminar akademik yang tersedia saat ini.</p>
                </div>
            @endforelse
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="py-12 mt-12 text-white border-t bg-secondary border-white/10">
        <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 gap-8 justify-items-center md:grid-cols-3">
                <div class="md:col-span-1">
                    <div class="flex gap-2 items-center mb-4">
                        <div class="flex justify-center items-center w-8 h-8 rounded-md bg-primary">
                            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-full h-full">
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