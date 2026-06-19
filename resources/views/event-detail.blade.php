<x-app-layout>
    <div class="max-w-4xl py-12 mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
            <h1 class="text-3xl font-bold text-gray-900">{{ $event->title }}</h1>
            <p class="mt-1 font-semibold text-indigo-600 text-md">{{ $event->category }} | {{ ucfirst($event->type) }}</p>
            
            <div class="py-4 mt-6 space-y-2 text-gray-700 border-t border-b border-gray-100">
                <p><strong>Pembicara:</strong> {{ $event->speaker }}</p>
                <p><strong>Tanggal & Waktu:</strong> {{ $event->event_date }}</p>
                <p><strong>Lokasi / Link:</strong> {{ $event->location }}</p>
                <p><strong>Harga Tiket:</strong> Rp {{ number_format($event->price, 0, ',', '.') }}</p>
                <p><strong>Deskripsi Seminar:</strong></p>
                <p class="text-gray-600">{{ $event->description }}</p>
            </div>

            <div class="p-4 mt-8 border border-gray-200 rounded-md bg-gray-50">
                <h3 class="mb-4 text-lg font-bold text-gray-800">Form Pendaftaran & Pembayaran</h3>
                
                <form action="{{ route('booking.store', $event->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf
                    <div class="p-3 text-sm text-yellow-800 border border-yellow-200 rounded bg-yellow-50">
                        <strong>Metode Pembayaran:</strong> Transfer Bank Mandiri 123-45678-90 a.n Rektorat Kampus Hub.
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Upload Bukti Transfer (Gambar)</label>
                        <input type="file" name="payment_proof" accept="image/*" class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100" required>
                    </div>

                    <button type="submit" class="w-full px-4 py-2 font-bold text-white transition bg-indigo-600 rounded hover:bg-indigo-700">
                        Kirim Bukti Pembayaran
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>