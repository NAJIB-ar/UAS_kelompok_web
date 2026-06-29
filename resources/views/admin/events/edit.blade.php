<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Edit Seminar: {{ $event->title }}
        </h2>
    </x-slot>

    <div class="max-w-4xl py-12 mx-auto sm:px-6 lg:px-8">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">

            <form action="{{ route('admin.events.update', $event->id) }}"
                method="POST"
                enctype="multipart/form-data">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 gap-6 md:grid-cols-2">

                    <div>
                        <label>Judul Seminar</label>
                        <input
                            type="text"
                            name="title"
                            value="{{ old('title', $event->title) }}"
                            required
                            class="block w-full mt-1 border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label>Nama Pembicara</label>
                        <input
                            type="text"
                            name="speaker"
                            value="{{ old('speaker', $event->speaker) }}"
                            required
                            class="block w-full mt-1 border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label>Kategori</label>
                        <input
                            type="text"
                            name="category"
                            value="{{ old('category', $event->category) }}"
                            required
                            class="block w-full mt-1 border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label>Tipe Pelaksanaan</label>
                        <select
                            name="type"
                            class="block w-full mt-1 border-gray-300 rounded-md">
                            <option value="online" {{ $event->type=='online' ? 'selected' : '' }}>
                                Online (Zoom/Meet)
                            </option>

                            <option value="offline" {{ $event->type=='offline' ? 'selected' : '' }}>
                                Offline (Tatap Muka)
                            </option>
                        </select>
                    </div>

                    <div>
                        <label>Tanggal & Waktu</label>
                        <input
                            type="datetime-local"
                            name="event_date"
                            value="{{ old('event_date', \Carbon\Carbon::parse($event->event_date)->format('Y-m-d\TH:i')) }}"
                            required
                            class="block w-full mt-1 border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label>Lokasi / Link</label>
                        <input
                            type="text"
                            name="location"
                            value="{{ old('location', $event->location) }}"
                            required
                            class="block w-full mt-1 border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label>Harga Tiket</label>
                        <input
                            type="number"
                            name="price"
                            value="{{ old('price', $event->price) }}"
                            min="0"
                            required
                            class="block w-full mt-1 border-gray-300 rounded-md">
                    </div>

                    <div>
                        <label>Kuota</label>
                        <input
                            type="number"
                            name="ticket_quantity"
                            value="{{ old('ticket_quantity', $event->ticket_quantity) }}"
                            min="1"
                            required
                            class="block w-full mt-1 border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="mt-6">
                    <label>Deskripsi Seminar</label>
                 <textarea
                        name="description"
                        rows="4"
                        required
                        class="block w-full mt-1 border-gray-300 rounded-md">{{ old('description', $event->description) }}</textarea>
                </div>
                
                <div class="mt-6">
                    <label>Update Poster (Opsional)</label>
                    <input
                        type="file"
                        name="image"
                        accept="image/*"
                        class="block w-full mt-1">
                    <p class="mt-1 text-xs text-gray-500">
                        Biarkan kosong jika tidak ingin mengubah gambar.
                    </p>
                </div>
                <div class="flex justify-end mt-8">

                    <!-- DELETE -->
                    {{-- <form
                        action="{{ route('admin.events.destroy', $event->id) }}"
                        method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus seminar ini?')">
                        @csrf
                        @method('DELETE')
                        <button
                            type="submit"
                            class="px-4 py-2 text-white bg-red-600 rounded hover:bg-red-700">
                            Hapus
                        </button>
                    </form> --}}
                    
                    <!-- UPDATE -->
                    <div>
                        <a
                            href="{{ route('admin.events.index') }}"
                            class="px-4 py-2 mr-3 text-gray-700 bg-gray-300 rounded">
                            Batal
                        </a>
                        <button
                            type="submit"
                            class="px-4 py-2 text-white bg-indigo-600 rounded hover:bg-indigo-700">
                            Perbarui Data
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
