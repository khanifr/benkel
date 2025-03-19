<?php

namespace App\Http\Controllers;

use App\Models\Sparepart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SparepartController extends Controller
{
    // Show all spareparts
    public function index()
    {
        $spareparts = Sparepart::all();
        return view('backend.sparepart.index', compact('spareparts'));
    }

    // Show the form for creating a new sparepart
    public function create()
    {
        return view('backend.sparepart.create');
    }

    // Store a newly created sparepart in the database
    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|string|max:20|unique:sparepart,kode',
            'nama' => 'required|string|max:100',
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        Sparepart::create($request->all());

        return redirect()->route('sparepart.index')->with('success', 'Sparepart berhasil ditambahkan.');
    }

    // Show the form for editing an existing sparepart
    public function edit($kode)
    {
        $sparepart = Sparepart::findOrFail($kode);
        return view('backend.sparepart.edit', compact('sparepart'));
    }

    // Update the specified sparepart in the database
    public function update(Request $request, $kode)
    {
        $request->validate([
            'kode' => 'required|string|max:20|unique:sparepart,kode,' . $kode . ',kode',
            'nama' => 'required|string|max:100',
            'jumlah' => 'required|integer',
            'harga' => 'required|integer',
        ]);

        $sparepart = Sparepart::findOrFail($kode);
        $sparepart->update($request->all());

        return redirect()->route('sparepart.index')->with('success', 'Sparepart berhasil diperbarui!');
    }

    // Remove the specified sparepart from the database
    public function destroy($kode)
    {
        $sparepart = Sparepart::findOrFail($kode);
        $sparepart->delete();

        return redirect()->route('sparepart.index')->with('success', 'Sparepart berhasil dihapus.');
    }
}
