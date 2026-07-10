 <x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Tambah Seminar Baru
        </h2>
    </x-slot>

    <div class="max-w-4xl py-12 mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
            
            <form action="{{ route('admin.events.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul Seminar</label>
                        <input type="text" name="title" value="{{ old('title') }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        @error('title') <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nama Pembicara</label>
                        <input type="text" name="speaker" value="{{ old('speaker') }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kategori (Contoh: UI/UX, Web Dev)</label>
                        <input type="text" name="category" value="{{ old('category') }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tipe Pelaksanaan</label>
                        <select name="type" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="online">Online (Zoom/Meet)</option>
                            <option value="offline">Offline (Tatap Muka)</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Tanggal & Waktu</label>
                        <input type="datetime-local" name="event_date" value="{{ old('event_date') }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Lokasi / Link Meeting</label>
                        <input type="text" name="location" value="{{ old('location') }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Harga Tiket (Rp) - Isi 0 jika gratis</label>
                        <input type="number" name="price" value="{{ old('price') }}" required min="0" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Kuota Peserta</label>
                        <input type="number" name="ticket_quantity" value="{{ old('ticket_quantity') }}" required min="1" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Deskripsi Seminar</label>
                    <textarea name="description" rows="4" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Poster Seminar (Opsional)</label>
                    <input type="file" name="image" accept="image/*" class="block w-full mt-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                </div>

                <div class="flex justify-end pt-4">
                    <a href="{{ route('admin.events.index') }}" class="px-4 py-2 mr-4 text-gray-700 bg-gray-200 rounded hover:bg-gray-300">Batal</a>
                    <button type="submit" class="px-4 py-2 font-bold text-white bg-indigo-600 rounded hover:bg-indigo-700">Simpan Data</button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout> 