@extends('kasir.barangs.layout')
 
@section('content')


<div x-data="{ open: false }" class="card bg-white p-6 rounded-lg shadow">

    <h2 class="text-2xl font-bold mb-4">Barang</h2>

    <div class="mb-4">
        <button @click="open = true" class="btn btn-success btn-sm bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            <i class="fa fa-plus"></i> Create New Barang
        </button>
    </div>

    <!-- ⬇️ MODAL MELAYANG MULAI DI SINI -->
    <div x-show="open" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" style="display: none;">
        <div @click.away="open = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
            <h2 class="text-xl font-bold mb-4">Tambah Barang</h2>
            <button @click="open = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-lg">&times;</button>

            <form action="{{ route('kasir.barangs.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Nama:</label>
                    <input type="text" name="nama" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Masukkan Nama">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Stok:</label>
                    <input type="number" name="stok" min="0" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Masukkan Stok">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Jenis:</label>
                    <input type="text" name="jenis" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Masukkan Jenis">
                </div>
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Harga:</label>
                    <input type="number" name="harga" min="0" class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Masukkan Harga">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" @click="open = false" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
                    <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600">Simpan</button>
                </div>
            </form>
        </div>
    </div>
    <!-- ⬆️ MODAL MELAYANG SELESAI -->

    @if ($message = Session::get('success'))
        <div class="alert alert-success bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ $message }}
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
                   <thead>
                    <tr class="bg-indigo-200">
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama</th>
                        <th class="border px-4 py-2">Stok</th>
                        <th class="border px-4 py-2">Jenis</th>
                        <th class="border px-4 py-2">Harga</th>
                        <th class="border px-4 py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($barangs as $barang)
                        <tr>
                            <td class="border px-4 py-2">{{ ++$i }}</td>
                            <td class="border px-4 py-2">{{ $barang->nama }}</td>
                            <td class="border px-4 py-2">{{ $barang->stok }}</td>
                            <td class="border px-4 py-2">{{ $barang->jenis }}</td>
                            <td class="border px-4 py-2">{{ $barang->harga }}</td>
                            <td class="border px-4 py-2 space-x-1">

                    <div x-data="{ showOpen: false }" class="inline">
                        <!-- Tombol Show -->
                        <button @click="showOpen = true" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">
                            <i class="fa fa-list"></i> Show
                        </button>

                        <!-- Modal Show -->
                        <div x-show="showOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" style="display: none;">
                            <div @click.away="showOpen = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-md relative">
                                <h2 class="text-xl font-bold mb-4">Detail Barang</h2>
                                <button @click="showOpen = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-lg">&times;</button>

                                <div class="mb-4">
                                    <strong>Nama:</strong>
                                    <div>{{ $barang->nama }}</div>
                                </div>
                                <div class="mb-4">
                                    <strong>Stok:</strong>
                                    <div>{{ $barang->stok }}</div>
                                </div>
                                <div class="mb-4">
                                    <strong>Jenis:</strong>
                                    <div>{{ $barang->jenis }}</div>
                                </div>
                                <div class="mb-4">
                                    <strong>Harga:</strong>
                                    <div>{{ $barang->harga }}</div>
                                </div>
                                <div class="flex justify-end">
                                    <button type="button" @click="showOpen = false" class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600">Tutup</button>
                                </div>
                            </div>
                        </div>
                        <!-- End Modal Show -->
                    </div>
    
                              <div x-data="{ editOpen: false }" class="inline">

                                  <button @click="editOpen = true" class="bg-yellow-500 text-white px-2 py-1 rounded hover:bg-yellow-600">
                                      <i class="fa fa-edit"></i> Edit
                                  </button>

                                  <div x-show="editOpen" class="fixed inset-0 flex items-center justify-center z-50 bg-black bg-opacity-50" style="display: none;">
                                      <div @click.away="editOpen = false" class="bg-white p-6 rounded-lg shadow-lg w-full max-w-lg relative">
                                          <h2 class="text-xl font-bold mb-4">Edit Barang</h2>
                                          <button @click="editOpen = false" class="absolute top-2 right-2 text-gray-500 hover:text-red-500 text-lg">&times;</button>

                                          <form action="{{ route('kasir.barangs.update', $barang->id) }}" method="POST">
                                              @csrf
                                              @method('PUT')
                                              <div class="mb-4">
                                                  <label class="block font-semibold mb-1">Nama:</label>
                                                  <input type="text" name="nama" value="{{ $barang->nama }}" required class="w-full border border-gray-300 rounded px-3 py-2">
                                              </div>
                                              <div class="mb-4">
                                                  <label class="block font-semibold mb-1">Stok:</label>
                                                  <input type="number" name="stok" min="0" value="{{ $barang->stok }}" required class="w-full border border-gray-300 rounded px-3 py-2">
                                              </div>
                                              <div class="mb-4">
                                                  <label class="block font-semibold mb-1">Jenis:</label>
                                                  <input type="text" name="jenis" value="{{ $barang->jenis }}" required class="w-full border border-gray-300 rounded px-3 py-2">
                                              </div>
                                              <div class="mb-4">
                                                  <label class="block font-semibold mb-1">Harga:</label>
                                                  <input type="number" name="harga" min="0" value="{{ $barang->harga }}" required class="w-full border border-gray-300 rounded px-3 py-2">
                                              </div>
                                              <div class="flex justify-end space-x-2">
                                                  <button type="button" @click="editOpen = false" class="px-4 py-2 rounded bg-gray-300 hover:bg-gray-400">Batal</button>
                                                  <button type="submit" class="px-4 py-2 rounded bg-blue-500 text-white hover:bg-blue-600">Update</button>
                                              </div>
                                          </form>
                                      </div>
                                  </div>

                              </div>
                                <form action="{{ route('kasir.barangs.destroy', $barang->id) }}" method="POST" class="inline" id="delete-form-{{ $barang->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" onclick="confirmDelete({{ $barang->id }})" class="bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600"><i class="fa fa-trash"></i> Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
        </table>
    </div>

    <div class="mt-4">
        {!! $barangs->links() !!}
    </div>
</div>

<script>
    function confirmDelete(id) {
        if (confirm('Ingin menghapus barang ini?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

@endsection
