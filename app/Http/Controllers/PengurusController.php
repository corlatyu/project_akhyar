<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Pengurus;

class PengurusController extends Controller
{
    public function index()
    {
        $penguruses = Pengurus::all();
        return view('penguruses.index', compact('penguruses'));
    }

    public function create()
    {
        return view('penguruses.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|unique:penguruses,nis',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nomor_tlp' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Handle Photo Upload
        if ($request->hasFile('foto')) {
            $fotoExtension = $request->file('foto')->getClientOriginalExtension();
            $randomName = Str::random(10) . '.' . $fotoExtension;
            $request->file('foto')->storeAs('public/foto_pengurus', $randomName);
            $request->merge(['foto' => $randomName]);
        }

        Pengurus::create($request->all());

        return redirect()->route('penguruses.index')
                         ->with('success', 'Data Pengurus berhasil ditambahkan');
    }

    public function show($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('penguruses.show', compact('pengurus'));
    }

    public function edit($id)
    {
        $pengurus = Pengurus::findOrFail($id);
        return view('penguruses.edit', compact('pengurus'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|unique:penguruses,nis,'.$id,
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'nomor_tlp' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Find the existing pengurus
        $pengurus = Pengurus::findOrFail($id);

        // Handle Photo Update
        if ($request->hasFile('foto')) {
            // Validate and store new photo
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Delete old photo if exists
            if ($pengurus->foto) {
                Storage::delete('public/foto_pengurus/' . $pengurus->foto);
            }

            // Store new photo
            $fotoExtension = $request->file('foto')->getClientOriginalExtension();
            $randomName = Str::random(10) . '.' . $fotoExtension;
            $request->file('foto')->storeAs('public/foto_pengurus', $randomName);
            $request->merge(['foto' => $randomName]);
        }

        // Update the pengurus record
        $pengurus->update($request->all());

        return redirect()->route('penguruses.index')
                         ->with('success', 'Data Pengurus berhasil diperbarui');
    }

    public function destroy($id)
    {
        $pengurus = Pengurus::findOrFail($id);

        // Delete photo from storage
        if ($pengurus->foto) {
            Storage::delete('public/foto_pengurus/' . $pengurus->foto);
        }

        // Delete the pengurus record
        $pengurus->delete();

        return redirect()->route('penguruses.index')
                         ->with('success', 'Data Pengurus berhasil dihapus');
    }
}
