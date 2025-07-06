<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangs = Barang::latest()->paginate(5);
        $role = request()->segment(1);

        return view($role . '.barangs.index', compact('barangs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = request()->segment(1);
        return view($role . '.barangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'stok' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        Barang::create($request->all());

        $role = request()->segment(1);
        return redirect()->route($role . '.barangs.index')
            ->with('Berhasil', 'Barang berhasil masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        $role = request()->segment(1);
        return view($role . '.barangs.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        $role = request()->segment(1);
        return view($role . '.barangs.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama' => 'required',
            'stok' => 'required',
            'jenis' => 'required',
            'harga' => 'required',
        ]);

        $barang->update($request->all());

        $role = request()->segment(1);
        return redirect()->route($role . '.barangs.index')
            ->with('Berhasil', 'Barang berhasil update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();

        $role = request()->segment(1);
        return redirect()->route($role . '.barangs.index')
            ->with('Berhasil', 'Barang berhasil delete');
    }
}
