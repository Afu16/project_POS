@extends('admin.transaksis.layout')

@section('content')

<div x-data="{ open: false }" class="card bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-bold mb-4">Data Transaksi</h2>

    <div class="mb-4">
        <button @click="open = true" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm">
            <i class="fa fa-plus"></i> Create New Transaksi
        </button>
    </div>

    {{-- Modal Create --}}
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" style="display: none;">
        <div @click.away="open = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
            <h2 class="text-lg font-bold mb-3">Tambah Transaksi</h2>
            <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>

            <form action="{{ route('admin.transaksis.store') }}" method="POST" class="space-y-3">
                @csrf
                <div>
                    <label class="block text-sm font-semibold mb-1">Nama Barang:</label>
                    <input type="text" name="nama_barang" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm" placeholder="Nama Barang" required>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Jenis:</label>
                    <input type="text" name="j_barang" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm" placeholder="Jenis Barang" required>
                </div>
                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <label class="block text-sm font-semibold mb-1">Harga:</label>
                        <input type="number" name="harga_barang" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm" placeholder="Harga" required>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-semibold mb-1">Tanggal:</label>
                        <input type="date" name="tgl_transaksi" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm" required>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <label class="block text-sm font-semibold mb-1">Tunai:</label>
                        <input type="number" name="tunai" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm" placeholder="Tunai" required>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-semibold mb-1">Total Barang:</label>
                        <input type="number" name="total_barang" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm" placeholder="Total Barang" required>
                    </div>
                </div>
                <div class="flex space-x-2">
                    <div class="w-1/2">
                        <label class="block text-sm font-semibold mb-1">Total Harga:</label>
                        <input type="number" name="total_harga" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm" placeholder="Total Harga" required>
                    </div>
                    <div class="w-1/2">
                        <label class="block text-sm font-semibold mb-1">Kembalian:</label>
                        <input type="number" name="kembalian" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm" placeholder="Kembalian" required>
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-semibold mb-1">Petugas:</label>
                    <input type="text" name="nama_petugas" class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm" placeholder="Nama Petugas" required>
                </div>
                <div class="flex justify-end space-x-2 pt-3">
                    <button type="button" @click="open = false" class="px-3 py-1.5 rounded bg-gray-300 hover:bg-gray-400 text-sm">Batal</button>
                    <button type="submit" class="px-3 py-1.5 rounded bg-blue-500 text-white hover:bg-blue-600 text-sm">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    {{-- End Modal Create --}}

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300 text-sm">
            <thead>
                <tr class="bg-indigo-200 text-left">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Nama Barang</th>
                    <th class="border px-4 py-2">Jenis</th>
                    <th class="border px-4 py-2">Harga</th>
                    <th class="border px-4 py-2">Tanggal</th>
                    <th class="border px-4 py-2">Tunai</th>
                    <th class="border px-4 py-2">Kembalian</th>
                    <th class="border px-4 py-2">Total Barang</th>
                    <th class="border px-4 py-2">Total Harga</th>
                    <th class="border px-4 py-2">Petugas</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transaksis as $transaksi)
                    <tr>
                        <td class="border px-4 py-2">{{ ++$i }}</td>
                        <td class="border px-4 py-2">{{ $transaksi->nama_barang }}</td>
                        <td class="border px-4 py-2">{{ $transaksi->j_barang }}</td>
                        <td class="border px-4 py-2">{{ $transaksi->harga_barang }}</td>
                        <td class="border px-4 py-2">{{ $transaksi->tgl_transaksi }}</td>
                        <td class="border px-4 py-2">{{ $transaksi->tunai }}</td>
                        <td class="border px-4 py-2">{{ $transaksi->kembalian }}</td>
                        <td class="border px-4 py-2">{{ $transaksi->total_barang }}</td>
                        <td class="border px-4 py-2">{{ $transaksi->total_harga }}</td>
                        <td class="border px-4 py-2">{{ $transaksi->nama_petugas }}</td>
                        <td class="border px-4 py-2 space-y-1">
                            {{-- Modal Show --}}
                            <div x-data="{ showOpen: false }" class="inline">
                                <button @click="showOpen = true" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 block text-center"><i class="fa fa-list"></i> Show</button>
                                <div x-show="showOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" style="display: none;">
                                    <div @click.away="showOpen = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                        <h2 class="text-xl font-bold mb-4">Detail Transaksi</h2>
                                        <button @click="showOpen = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-lg">&times;</button>
                                        <div class="mb-2"><strong>Nama Barang:</strong> {{ $transaksi->nama_barang }}</div>
                                        <div class="mb-2"><strong>Jenis:</strong> {{ $transaksi->j_barang }}</div>
                                        <div class="mb-2"><strong>Harga:</strong> {{ $transaksi->harga_barang }}</div>
                                        <div class="mb-2"><strong>Tanggal:</strong> {{ $transaksi->tgl_transaksi }}</div>
                                        <div class="mb-2"><strong>Tunai:</strong> {{ $transaksi->tunai }}</div>
                                        <div class="mb-2"><strong>Kembalian:</strong> {{ $transaksi->kembalian }}</div>
                                        <div class="mb-2"><strong>Total Barang:</strong> {{ $transaksi->total_barang }}</div>
                                        <div class="mb-2"><strong>Total Harga:</strong> {{ $transaksi->total_harga }}</div>
                                        <div class="mb-2"><strong>Petugas:</strong> {{ $transaksi->nama_petugas }}</div>
                                        <div class="flex justify-end mt-4">
                                            <button type="button" @click="showOpen = false" class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Modal Edit --}}
                            <div x-data="{ editOpen: false }" class="inline">
                                <button @click="editOpen = true" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600 block text-center text-sm"><i class="fa fa-edit"></i> Edit</button>
                                <div x-show="editOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" style="display: none;">
                                    <div @click.away="editOpen = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
                                        <h2 class="text-lg font-bold mb-3">Edit Transaksi</h2>
                                        <button @click="editOpen = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-xl">&times;</button>

                                        <form action="{{ route('transaksis.update', $transaksi->id) }}" method="POST" class="space-y-3">
                                            @csrf
                                            @method('PUT')
                                            <div>
                                                <label class="block text-sm font-semibold mb-1">Nama Barang:</label>
                                                <input type="text" name="nama_barang" value="{{ $transaksi->nama_barang }}" required class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold mb-1">Jenis:</label>
                                                <input type="text" name="j_barang" value="{{ $transaksi->j_barang }}" required class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                                            </div>
                                            <div class="flex space-x-2">
                                                <div class="w-1/2">
                                                    <label class="block text-sm font-semibold mb-1">Harga:</label>
                                                    <input type="number" name="harga_barang" value="{{ $transaksi->harga_barang }}" required class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label class="block text-sm font-semibold mb-1">Tanggal:</label>
                                                    <input type="date" name="tgl_transaksi" value="{{ $transaksi->tgl_transaksi }}" required class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <div class="w-1/2">
                                                    <label class="block text-sm font-semibold mb-1">Tunai:</label>
                                                    <input type="number" name="tunai" value="{{ $transaksi->tunai }}" required class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label class="block text-sm font-semibold mb-1">Total Barang:</label>
                                                    <input type="number" name="total_barang" value="{{ $transaksi->total_barang }}" required class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                                                </div>
                                            </div>
                                            <div class="flex space-x-2">
                                                <div class="w-1/2">
                                                    <label class="block text-sm font-semibold mb-1">Total Harga:</label>
                                                    <input type="number" name="total_harga" value="{{ $transaksi->total_harga }}" required class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                                                </div>
                                                <div class="w-1/2">
                                                    <label class="block text-sm font-semibold mb-1">Kembalian:</label>
                                                    <input type="number" name="kembalian" value="{{ $transaksi->kembalian }}" required class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                                                </div>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-semibold mb-1">Petugas:</label>
                                                <input type="text" name="nama_petugas" value="{{ $transaksi->nama_petugas }}" required class="w-full border border-gray-300 rounded px-3 py-1.5 text-sm">
                                            </div>
                                            <div class="flex justify-end space-x-2 pt-3">
                                                <button type="button" @click="editOpen = false" class="px-3 py-1.5 rounded bg-gray-300 hover:bg-gray-400 text-sm">Batal</button>
                                                <button type="submit" class="px-3 py-1.5 rounded bg-blue-500 text-white hover:bg-blue-600 text-sm">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            {{-- Delete --}}
                            <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST" class="inline" id="delete-form-{{ $transaksi->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $transaksi->id }})" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600 w-full"><i class="fa fa-trash"></i> Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {!! $transaksis->links() !!}
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Ingin menghapus transaksi ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

@endsection
