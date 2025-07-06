<?php

namespace App\Http\Controllers;

use App\Models\Jenis_barang;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class Jenis_barangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jenis_barangs = Jenis_barang::latest()->paginate();
        $role = request()->segment(1);

        return view($role . '.jenis_barangs.index', compact('jenis_barangs'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $role = request()->segment(1);
        return view($role . '.jenis_barangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'j_barang' => 'required',
        ]);

        Jenis_barang::create($request->all());

        $role = request()->segment(1);
        return redirect()->route($role . '.jenis_barangs.index')
            ->with('Berhasil', 'Jenis barang berhasil masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jenis_barang $jenis_barang)
    {
        $role = request()->segment(1);
        return view($role . '.jenis_barangs.show', compact('jenis_barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jenis_barang $jenis_barang)
    {
        $role = request()->segment(1);
        return view($role . '.jenis_barangs.edit', compact('jenis_barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Jenis_barang $jenis_barang)
    {
        $request->validate([
            'j_barang' => 'required',
        ]);

        $jenis_barang->update($request->all());

        $role = request()->segment(1);
        return redirect()->route($role . '.jenis_barangs.index')
            ->with('Berhasil', 'Jenis barang berhasil update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jenis_barang $jenis_barang)
    {
        $jenis_barang->delete();

        $role = request()->segment(1);
        return redirect()->route($role . '.jenis_barangs.index')
            ->with('Berhasil', 'Jenis barang berhasil delete');
    }
}
