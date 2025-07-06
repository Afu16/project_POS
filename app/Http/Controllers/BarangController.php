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

        return view('admin.barangs.index',compact('barangs'))
        ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.barangs.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
          'nama'=>'required',
          'stok'=>'required',
          'jenis'=>'required',
          'harga'=>'required',

        ]);

        Barang::create($request->all());

        return redirect()->route('admin.barangs.index')
        ->with('Berhasil','barang berhasil masuk');
    }

    /**
     * Display the specified resource.
     */
    public function show(Barang $barang)
    {
        return view('admin.barangs.show',compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Barang $barang)
    {
        return view('admin.barangs.edit', compact('barang'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Barang $barang)
    {
        $request->validate([
         'nama'=>'required',
          'stok'=>'required',
          'jenis'=>'required',
          'harga'=>'required',

        ]);
         $barang->update($request->all());
         return redirect()->route('admin.barangs.index')
         ->with('Berhasil','barang berhasil update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Barang $barang)
    {
        $barang->delete();
        return redirect()->route('admin.barangs.index')
        ->with('Berhasil','barang berhasil delete');
    } 

}
