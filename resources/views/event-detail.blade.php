<x-app-layout>
    <div class="max-w-4xl py-12 mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">

            <!-- Detail Event -->
            <h1 class="text-3xl font-bold text-gray-900">
                {{ $event->title }}
            </h1>

            <p class="mt-2 font-semibold text-indigo-600">
                {{ $event->category }} | {{ ucfirst($event->type) }}
            </p>

            <div class="py-4 mt-6 space-y-3 border-t border-b border-gray-200">

                <p>
                    <strong>Pembicara :</strong>
                    {{ $event->speaker }}
                </p>

                <p>
                    <strong>Tanggal & Waktu :</strong>
                    {{ \Carbon\Carbon::parse($event->event_date)->format('d M Y H:i') }}
                </p>

                <p>
                    <strong>Lokasi / Link :</strong>
                    {{ $event->location }}
                </p>

                <p>
                    <strong>Harga Tiket :</strong>
                    Rp {{ number_format($event->price, 0, ',', '.') }}
                </p>

                <div>
                    <strong>Deskripsi Seminar :</strong>
                    <p class="mt-2 text-gray-600">
                        {{ $event->description }}
                    </p>
                </div>

            </div>

            <!-- Form Pembayaran -->
            <div class="p-5 mt-8 border rounded-lg bg-gray-50">

                <h3 class="mb-4 text-xl font-bold text-gray-800">
                    Form Pendaftaran & Pembayaran
                </h3>

                {{-- Pesan sukses --}}
                @if(session('success'))
                    <div class="p-3 mb-4 text-green-700 bg-green-100 border border-green-300 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Error validasi --}}
                @if ($errors->any())
                    <div class="p-3 mb-4 text-red-700 bg-red-100 border border-red-300 rounded">
                        <ul class="pl-5 list-disc">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('booking.store', $event->id) }}"
                      method="POST"
                      enctype="multipart/form-data"
                      class="space-y-4">

                    @csrf

                    <div class="p-4 text-sm text-yellow-800 border border-yellow-300 rounded bg-yellow-50">
                        <strong>Metode Pembayaran</strong><br>
                        Transfer Bank Mandiri<br>
                        No. Rekening: <strong>123-45678-90</strong><br>
                        a.n <strong>Rektorat Kampus Hub</strong>
                    </div>

                    <div>
                        <label class="block mb-2 text-sm font-medium text-gray-700">
                            Upload Bukti Transfer
                        </label>

                        <input
                            type="file"
                            name="payment_proof"
                            accept="image/*"
                            required
                            class="block w-full text-sm text-gray-500
                                   file:mr-4
                                   file:py-2
                                   file:px-4
                                   file:border-0
                                   file:rounded-md
                                   file:bg-indigo-50
                                   file:text-indigo-700
                                   hover:file:bg-indigo-100">
                    </div>

                    <button
                        type="submit"
                        class="w-full px-4 py-2 font-bold text-white transition bg-indigo-600 rounded-lg hover:bg-indigo-700">
                        Kirim Bukti Pembayaran
                    </button>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>