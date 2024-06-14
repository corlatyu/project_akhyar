<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Guru;

class GuruController extends Controller
{
    public function index()
    {
        $gurus = Guru::all();
        return view('gurus.index', compact('gurus'));
    }

    public function create()
    {
        return view('gurus.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Handle Photo Upload
        if ($request->hasFile('foto')) {
            $fotoExtension = $request->file('foto')->getClientOriginalExtension();
            $randomName = Str::random(10) . '.' . $fotoExtension;
            $request->file('foto')->storeAs('public/foto_guru', $randomName);
            $request->merge(['foto' => $randomName]);
        }

        Guru::create($request->all());

        return redirect()->route('gurus.index')
                         ->with('success', 'Data Guru berhasil ditambahkan');
    }

    public function show($id)
    {
        $guru = Guru::findOrFail($id);
        return view('gurus.show', compact('guru'));
    }

    public function edit($id)
    {
        $guru = Guru::findOrFail($id);
        return view('gurus.edit', compact('guru'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required',
            'alamat' => 'required',
            'foto' => 'nullable|image|max:2048',
        ]);

        // Find the existing guru
        $guru = Guru::findOrFail($id);

        // Handle Photo Update
        if ($request->hasFile('foto')) {
            // Validate and store new photo
            $request->validate([
                'foto' => 'image|mimes:jpeg,png,jpg|max:2048',
            ]);

            // Delete old photo if exists
            if ($guru->foto) {
                Storage::delete('public/foto_guru/' . $guru->foto);
            }

            // Store new photo
            $fotoExtension = $request->file('foto')->getClientOriginalExtension();
            $randomName = Str::random(10) . '.' . $fotoExtension;
            $request->file('foto')->storeAs('public/foto_guru', $randomName);
            $request->merge(['foto' => $randomName]);
        }

        // Update the guru record
        $guru->update($request->all());

        return redirect()->route('gurus.index')
                         ->with('success', 'Data Guru berhasil diperbarui');
    }

    public function destroy($id)
    {
        $guru = Guru::findOrFail($id);

        // Delete photo from storage
        if ($guru->foto) {
            Storage::delete('public/foto_guru/' . $guru->foto);
        }

        // Delete the guru record
        $guru->delete();

        return redirect()->route('gurus.index')
                         ->with('success', 'Data Guru berhasil dihapus');
    }
}
