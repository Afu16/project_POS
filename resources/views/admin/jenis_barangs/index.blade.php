@extends('admin.jenis_barangs.layout')

@section('content')

<div x-data="{ open: false }" class="card bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-bold mb-4">Data Jenis Barang</h2>

    <div class="mb-4">
        <button @click="open = true" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600 text-sm">
            <i class="fa fa-plus"></i> Create New Jenis Barang
        </button>
    </div>

    <!-- Modal Create -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" style="display: none;">
        <div @click.away="open = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
            <h2 class="text-xl font-bold mb-4">Tambah Jenis Barang</h2>
            <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-lg">&times;</button>

            <form action="{{ route('jenis_barangs.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Jenis Barang:</label>
                    <input type="text" name="j_barang" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Masukkan Jenis Barang" required>
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" @click="open = false" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- End Modal Create -->

    @if ($message = Session::get('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300 text-sm">
            <thead>
                <tr class="bg-indigo-200">
                    <th class="border px-4 py-2">No</th>
                    <th class="border px-4 py-2">Jenis Barang</th>
                    <th class="border px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jenis_barangs as $jenis_barang)
                    <tr>
                        <td class="border px-4 py-2">{{ ++$i }}</td>
                        <td class="border px-4 py-2">{{ $jenis_barang->j_barang }}</td>
                        <td class="border px-4 py-2 space-x-1">

                            <!-- Show Modal -->
                            <div x-data="{ showOpen: false }" class="inline">
                                <button @click="showOpen = true" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600 inline-block"><i class="fa fa-list"></i> Show</button>
                                <div x-show="showOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" style="display: none;">
                                    <div @click.away="showOpen = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                        <h2 class="text-xl font-bold mb-4">Detail Jenis Barang</h2>
                                        <button @click="showOpen = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-lg">&times;</button>
                                        <div class="mb-4">
                                            <strong>Jenis Barang:</strong>
                                            <div>{{ $jenis_barang->j_barang }}</div>
                                        </div>
                                        <div class="flex justify-end">
                                            <button type="button" @click="showOpen = false" class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Modal -->
                            <div x-data="{ editOpen: false }" class="inline">
                                <button @click="editOpen = true" class="bg-yellow-500 text-white px-3 py-1 rounded hover:bg-yellow-600 inline-block"><i class="fa fa-edit"></i> Edit</button>
                                <div x-show="editOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" style="display: none;">
                                    <div @click.away="editOpen = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                        <h2 class="text-xl font-bold mb-4">Edit Jenis Barang</h2>
                                        <button @click="editOpen = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-lg">&times;</button>
                                        <form action="{{ route('jenis_barangs.update', $jenis_barang->id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="mb-4">
                                                <label class="block font-semibold mb-1">Jenis Barang:</label>
                                                <input type="text" name="j_barang" value="{{ $jenis_barang->j_barang }}" required class="w-full border border-gray-300 rounded px-3 py-2">
                                            </div>
                                            <div class="flex justify-end space-x-2">
                                                <button type="button" @click="editOpen = false" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
                                                <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600">Update</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete -->
                            <form action="{{ route('jenis_barangs.destroy', $jenis_barang->id) }}" method="POST" class="inline" id="delete-form-{{ $jenis_barang->id }}">
                                @csrf
                                @method('DELETE')
                                <button type="button" onclick="confirmDelete({{ $jenis_barang->id }})" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 inline-block">
                                    <i class="fa fa-trash"></i> Delete
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {!! $jenis_barangs->links() !!}
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Ingin menghapus jenis barang ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

@endsection
