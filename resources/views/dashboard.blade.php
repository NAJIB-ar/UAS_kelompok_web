<x-app-layout>
    <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <h1 class="mb-6 text-2xl font-bold text-gray-800">Pilihan Seminar Akademik</h1>
        
        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            @foreach($events as $event)
                <div class="p-4 bg-white border border-gray-200 rounded-lg shadow-md">
                    <span class="px-2 py-1 text-xs font-semibold text-blue-800 bg-blue-100 rounded">{{ $event->category }}</span>
                    <h2 class="mt-2 text-lg font-bold text-gray-900">{{ $event->title }}</h2>
                    <p class="text-sm text-gray-600">Pembicara: {{ $event->speaker }}</p>
                    <p class="mt-2 text-sm font-semibold text-indigo-600">Harga: Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                    <p class="mt-1 text-xs text-gray-500">Sisa Kuota: {{ $event->ticket_quantity }}</p>
                    
                    <a href="{{ route('event.show', $event->id) }}" class="block py-2 mt-4 text-sm font-semibold text-center text-white transition bg-indigo-600 rounded-md hover:bg-indigo-700">
                        Lihat Detail
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>