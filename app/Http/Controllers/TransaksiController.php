<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaksis = Transaksi::latest()->paginate(5);
        $role = request()->segment(1); // Ambil 'admin' atau 'kasir'

        return view($role . '.transaksis.index', compact('transaksis'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = request()->segment(1);
        return view($role . '.transaksis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
public function store(Request $request)
{
    $validated = $request->validate([
        'nama_barang' => 'required',
        'j_barang' => 'required',
        'harga_barang' => 'required|numeric',
        'tgl_transaksi' => 'required|date',
        'tunai' => 'required|numeric',
        'kembalian' => 'required|numeric',
        'total_barang' => 'required|numeric',
        'total_harga' => 'required|numeric',
        'nama_petugas' => 'required',
    ]);

    Transaksi::create($validated);
     $role = request()->segment(1);
    return redirect()->route($role . '.transaksis.index')->with('success', 'Transaksi berhasil ditambah');
}

    /**
     * Display the specified resource.
     */
    public function show(Transaksi $transaksi)
    {
        $role = request()->segment(1);
        return view($role . '.transaksis.show', compact('transaksi'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaksi $transaksi)
    {
        $role = request()->segment(1);
        return view($role . '.transaksis.edit', compact('transaksi'));
    }

    /**
     * Update the specified resource in storage.
     */
 public function update(Request $request, Transaksi $transaksi)
{
    $validated = $request->validate([
        'nama_barang' => 'required',
        'j_barang' => 'required',
        'harga_barang' => 'required|numeric',
        'tgl_transaksi' => 'required|date',
        'tunai' => 'required|numeric',
        'kembalian' => 'required|numeric',
        'total_barang' => 'required|numeric',
        'total_harga' => 'required|numeric',
        'nama_petugas' => 'required',
    ]);

    $transaksi->update($validated);
    $role = request()->segment(1);
    return redirect()->route($role . '.transaksis.index')->with('success', 'Transaksi berhasil diupdate');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
       $role = request()->segment(1);
       return redirect()->route($role . '.transaksis.index')->with('Berhasil', 'Transaksi berhasil dihapus');
    }
}
