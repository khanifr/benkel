<?php

namespace App\Http\Controllers;

use App\Models\JasaServis;
use Illuminate\Http\Request;

class JasaServisController extends Controller
{
    // Show all jasa servis
    public function index()
    {
        $jasaServis = JasaServis::all();
        return view('backend.jasa_servis.index', compact('jasaServis'));
    }

    // Show the form for creating a new jasa servis
    public function create()
    {
        return view('backend.jasa_servis.create');
    }

    // Store a newly created jasa servis in the database
    public function store(Request $request)
    {
        $request->validate([
            'jenis' => 'required|string|max:100|unique:jasa_servis,jenis',
            'harga' => 'required|integer',
        ]);

        JasaServis::create($request->all());

        return redirect()->route('jasa_servis.index')->with('success', 'Jasa Servis created successfully.');
    }

    // Show the form for editing an existing jasa servis
    public function edit($id)
    {
        $jasaServis = JasaServis::findOrFail($id);
        return view('backend.jasa_servis.edit', compact('jasaServis'));
    }

    // Update the specified jasa servis in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'jenis' => 'required|string|max:100|unique:jasa_servis,jenis,' . $id,
            'harga' => 'required|integer',
        ]);

        $jasaServis = JasaServis::findOrFail($id);
        $jasaServis->update($request->all());

        return redirect()->route('jasa_servis.index')->with('success', 'Jasa Servis updated successfully.');
    }

    // Remove the specified jasa servis from the database
    public function destroy($id)
    {
        $jasaServis = JasaServis::findOrFail($id);
        $jasaServis->delete();

        return redirect()->route('jasa_servis.index')->with('success', 'Jasa Servis deleted successfully.');
    }
}
