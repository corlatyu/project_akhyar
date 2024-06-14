<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SantriController extends Controller
{
    public function index()
    {
        $santris = Santri::all();
        return view('admin.santri.index', compact('santris'));
    }

    public function create()
    {
        return view('santris.create');
    }
    
    
   public function store(Request $request)
{
    // Sebelum Validasi
    // dd($request->all());

    $validator = Validator::make($request->all(), [
        'nis' => 'required|unique:santris,nis|numeric|digits:6',
        'nama' => 'required',
        'nik' => 'required|unique:santris,nik|numeric|digits:16',
        'jenis_kelamin' => 'required',
        'kamar' => 'required',
        'jenjang' => 'required',
        'tempat_lahir' => 'required',
        'tgl_lahir' => 'required|date', // Menambahkan validasi untuk tgl_lahir
        'alamat' => 'required',
        'provinsi' => 'required',
        'kabupaten' => 'required',
        'nama_ayah' => 'required',
        'nama_ibu' => 'required',
        'nomor_tlp_ortu' => 'required|numeric|digits_between:10,15', // Menyesuaikan validasi untuk nomor telepon
        'no_kk' => 'required|numeric|digits:16', // Menambahkan validasi digits untuk No_KK
        'status' => 'required',
        'foto' => 'required|image|mimes:jpeg,png,jpg|max:2048'
    ], [
        'nis.numeric' => 'NIS harus berupa angka.',
        'nis.digits' => 'NIS harus terdiri dari 6 digit.',
        'nik.numeric' => 'NIK harus berupa angka.',
        'nik.digits' => 'NIK harus terdiri dari 16 digit.',
        'nomor_tlp_ortu.numeric' => 'Nomor Telepon Orang Tua harus berupa angka.',
        'nomor_tlp_ortu.digits_between' => 'Nomor Telepon Orang Tua harus terdiri dari 10 sampai 15 digit.',
        'no_kk.numeric' => 'Nomor KK harus berupa angka.',
        'no_kk.digits' => 'Nomor KK harus terdiri dari 16 digit.'
    ]);

    if ($validator->fails()) {
        return redirect()
            ->back()
            ->withErrors($validator)
            ->withInput();
    }

    // Setelah Validasi Berhasil
    // dd($request->all());

    if ($request->hasFile('foto')) {
        $fotoExtension = $request->file('foto')->getClientOriginalExtension();
        $randomName = Str::random(10) . '.' . $fotoExtension;
    
        $request->file('foto')->storeAs('public/gambar_santri', $randomName);
    
        $data = $request->only([
            'nis', 'nama', 'nik', 'jenis_kelamin', 'kamar', 'jenjang',
            'tempat_lahir', 'tgl_lahir', 'alamat', 'provinsi', 'kabupaten',
            'nama_ayah', 'nama_ibu', 'nomor_tlp_ortu', 'no_kk', 'status'
        ]);
        $data['foto'] = $randomName;
    
        Santri::create($data);
    }

    return redirect()->route('santris.index')
                     ->with('success', 'Data Santri berhasil ditambahkan');
}

    
    
    public function show($id)
    {
        $santri = Santri::findOrFail($id);
        return view('santris.show', compact('santri'));
    }

    public function edit($id)
    {
        $santri = Santri::findOrFail($id);
        return view('santris.edit', compact('santri'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nis' => 'required|unique:santris,nis,' . $id,
            'nama' => 'required',
            'nik' => 'required|unique:santris,nik,' . $id,
            'jenis_kelamin' => 'required|in:L,P',
            'kamar' => 'required',
            'jenjang' => 'required',
            'tempat_lahir' => 'required',
            'tgl_lahir' => 'required|date', // Menambahkan validasi untuk tgl_lahir
            'alamat' => 'required',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'nama_ayah' => 'required',
            'nama_ibu' => 'required',
            'nomor_tlp_ortu' => 'required|numeric|digits_between:10,15', // Menyesuaikan validasi untuk nomor telepon
            'no_kk' => 'required|numeric|digits:16', // Menambahkan validasi digits untuk No_KK
            'status' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        // Find the existing santri
        $santri = Santri::findOrFail($id);
    
        // Handle Photo Update
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($santri->foto) {
                Storage::delete('public/gambar_santri/' . $santri->foto);
            }
    
            // Store new photo
            $fotoExtension = $request->file('foto')->getClientOriginalExtension();
            $randomName = Str::random(10) . '.' . $fotoExtension;
            $request->file('foto')->storeAs('public/gambar_santri', $randomName);
            $request->merge(['foto' => $randomName]);
        }
    
        // Update the santri record
        $santri->update($request->all());
    
        return redirect()->route('santris.index')
                         ->with('success', 'Data Santri berhasil diperbarui');
    }
    public function destroy($id)
    {
        $santri = Santri::findOrFail($id);
        $santri->delete();

        return redirect()->route('santris.index')
                         ->with('success', 'Data Santri berhasil dihapus');
    }
}
