<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Kelola Data Seminar
        </h2>
    </x-slot>

    <div class="py-12 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
            
            @if(session('success'))
                <div class="p-4 mb-4 text-green-800 bg-green-100 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">Daftar Seminar Aktif</h1>
                <a href="{{ route('admin.events.create') }}" class="px-4 py-2 font-bold text-white transition bg-indigo-600 rounded hover:bg-indigo-700">
                    + Tambah Seminar
                </a>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                    <thead>
                        <tr class="text-sm tracking-wider text-left text-gray-600 uppercase bg-gray-50">
                            <th class="px-4 py-3 border-b">Judul Seminar</th>
                            <th class="px-4 py-3 border-b">Tanggal</th>
                            <th class="px-4 py-3 border-b">Kuota</th>
                            <th class="px-4 py-3 border-b">Harga</th>
                            <th class="px-4 py-3 text-center border-b">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-gray-700">
                        @forelse($events as $event)
                            <tr class="transition hover:bg-gray-50">
                                <td class="px-4 py-3 font-semibold border-b">{{ $event->title }}<br><span class="text-xs text-gray-500">{{ $event->category }} | {{ $event->type }}</span></td>
                                <td class="px-4 py-3 border-b">{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, H:i') }}</td>
                                <td class="px-4 py-3 border-b">{{ $event->ticket_quantity }}</td>
                                <td class="px-4 py-3 border-b">Rp {{ number_format($event->price, 0, ',', '.') }}</td>
                                <td class="px-4 py-3 space-x-2 text-center border-b">
                                    <a href="{{ route('admin.events.edit', $event->id) }}" class="inline-block px-3 py-1 text-xs text-white bg-blue-500 rounded hover:bg-blue-600">Edit</a>
                                    
                                    <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="px-3 py-1 text-xs text-white bg-red-600 rounded hover:bg-red-700" onclick="return confirm('Yakin ingin menghapus seminar ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="py-6 text-center text-gray-500">Belum ada data seminar.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout> 