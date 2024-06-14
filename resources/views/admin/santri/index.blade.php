@extends('layouts.master')

@section('title', 'Daftar Santri')

@section('content')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Data Santri</h6>
                <!-- Button trigger modal -->
                <div>
                    <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#tambahSantriModal">
                        <i class="fas fa-plus-circle mr-2"></i> Tambah Santri
                    </button>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if ($santris->isEmpty())
                <p>Tidak ada data santri.</p>
            @else
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Foto</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Jenis Kelamin</th>
                                <th>Kamar</th>
                                <th>Jenjang</th>
                                <th>Tempat Lahir</th>
                                <th>Alamat</th>
                                <th>Provinsi</th>
                                <th>Kabupaten</th>
                                <th>Nama Ayah</th>
                                <th>Nama Ibu</th>
                                <th>Nomor Tlp Ortu</th>
                                <th>No KK</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($santris as $santri)
                                <tr>
                                    <td>{{ $santri->id }}</td>
                                    <td><img src="{{ asset('storage/gambar_santri/'.$santri->foto)}}" alt="Foto Santri" class="img-thumbnail" style="max-width: 50px; max-height: 50px;"></td>
                                    <td>{{ $santri->nis }}</td>
                                    <td>{{ $santri->nama }}</td>
                                    <td>{{ $santri->nik }}</td>
                                    <td>{{ $santri->jenis_kelamin }}</td>
                                    <td>{{ $santri->kamar }}</td>
                                    <td>{{ $santri->jenjang }}</td>
                                    <td>{{ $santri->tempat_lahir }}</td>
                                    <td>{{ $santri->alamat }}</td>
                                    <td>{{ $santri->provinsi }}</td>
                                    <td>{{ $santri->kabupaten }}</td>
                                    <td>{{ $santri->nama_ayah }}</td>
                                    <td>{{ $santri->nama_ibu }}</td>
                                    <td>{{ $santri->nomor_tlp_ortu }}</td>
                                    <td>{{ $santri->no_kk }}</td>
                                    <td>{{ $santri->status }}</td>
                                    <td>
                                        <a href="{{ route('santris.show', $santri->id) }}"
                                            class="btn btn-sm btn-info">Detail</a>
                                        <a href="{{ route('santris.edit', $santri->id) }}"
                                            class="btn btn-sm btn-primary">Edit</a>
                                        <form action="{{ route('santris.destroy', $santri->id) }}" method="POST"
                                            style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Tambah Santri -->
    <div class="modal fade" id="tambahSantriModal" tabindex="-1" role="dialog" aria-labelledby="tambahSantriModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{ route('santris.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="tambahSantriModalLabel">Tambah Santri Baru</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Form tambah santri -->
                        <div class="form-group">
                            <label for="nis">NIS (Nomor Induk Siswa)</label>
                            <input type="text" class="form-control @error('nis') is-invalid @enderror" id="nis"
                                name="nis" value="{{ old('nis') }}" maxlength="6" pattern="[0-9]{1,6}"
                                title="Hanya angka dengan maksimal 6 digit" required>
                            @error('nis')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nik">NIK (Nomor Induk Kependudukan)</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik"
                                name="nik" value="{{ old('nik') }}" maxlength="16" pattern="[0-9]{1,16}"
                                title="Hanya angka dengan maksimal 16 digit" required>
                            @error('nik')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin"
                                name="jenis_kelamin" required>
                                <option value="">Pilih Jenis Kelamin</option>
                                <option value="L" {{ old('jenis_kelamin') == 'Laki-laki' ? 'selected' : '' }}>
                                    Laki-laki</option>
                                <option value="P" {{ old('jenis_kelamin') == 'Perempuan' ? 'selected' : '' }}>
                                    Perempuan</option>
                            </select>
                            @error('jenis_kelamin')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kamar">Kamar</label>
                            <select class="form-control @error('kamar') is-invalid @enderror" id="kamar" name="kamar"
                                required>
                                <option value="">Pilih Kamar</option>
                                <option value="DF02" {{ old('kamar') == 'DF02' ? 'selected' : '' }}>DF02</option>
                                <option value="DF03" {{ old('kamar') == 'DF03' ? 'selected' : '' }}>DF03</option>
                                <option value="DF04" {{ old('kamar') == 'DF04' ? 'selected' : '' }}>DF04</option>
                                <option value="DF05" {{ old('kamar') == 'DF05' ? 'selected' : '' }}>DF05</option>
                                <option value="DF06" {{ old('kamar') == 'DF06' ? 'selected' : '' }}>DF06</option>
                                <option value="DS24" {{ old('kamar') == 'DS24' ? 'selected' : '' }}>DS24</option>
                                <option value="DS25" {{ old('kamar') == 'DS25' ? 'selected' : '' }}>DS25</option>
                                <option value="DS26" {{ old('kamar') == 'DS26' ? 'selected' : '' }}>DS26</option>
                                <option value="DS27" {{ old('kamar') == 'DS27' ? 'selected' : '' }}>DS27</option>
                                <option value="DS28" {{ old('kamar') == 'DS28' ? 'selected' : '' }}>DS28</option>
                                <option value="DS29" {{ old('kamar') == 'DS29' ? 'selected' : '' }}>DS29</option>
                                <option value="DT01" {{ old('kamar') == 'DT01' ? 'selected' : '' }}>DT01</option>
                                <option value="DT02" {{ old('kamar') == 'DT02' ? 'selected' : '' }}>DT02</option>
                                <option value="DT03" {{ old('kamar') == 'DT03' ? 'selected' : '' }}>DT03</option>
                                <option value="DT04" {{ old('kamar') == 'DT04' ? 'selected' : '' }}>DT04</option>
                            </select>
                            @error('kamar')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jenjang">Jenjang</label>
                            <select class="form-control @error('jenjang') is-invalid @enderror" id="jenjang"
                                name="jenjang" required>
                                <option value="">Pilih Jenjang</option>
                                <option value="Aliyah" {{ old('jenjang') == 'Aliyah' ? 'selected' : '' }}>Aliyah</option>
                                <option value="Tsanawiyah" {{ old('jenjang') == 'Tsanawiyah' ? 'selected' : '' }}>
                                    Tsanawiyah</option>
                                <option value="Ibtidaiyah" {{ old('jenjang') == 'Ibtidaiyah' ? 'selected' : '' }}>
                                    Ibtidaiyah</option>
                                <option value="StaffPengajar" {{ old('jenjang') == 'StaffPengajar' ? 'selected' : '' }}>
                                    Staff Pengajar</option>
                            </select>
                            @error('jenjang')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="tempat_lahir">Tempat Lahir</label>
                            <input type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                                id="tempat_lahir" name="tempat_lahir" value="{{ old('tempat_lahir') }}" required>
                            @error('tempat_lahir')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        
                        <div class="form-group">
                            <label for="tgl_lahir">Tanggal Lahir</label>
                            <input type="date" class="form-control @error('tgl_lahir') is-invalid @enderror"
                                id="tgl_lahir" name="tgl_lahir" value="{{ old('tgl_lahir') }}" required>
                            @error('tgl_lahir')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                        

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3"
                                required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="provinsi">Provinsi</label>
                            <input type="text" class="form-control @error('provinsi') is-invalid @enderror"
                                id="provinsi" name="provinsi" value ="{{ old('provinsi') }}" required>
                            @error('provinsi')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="kabupaten">Kabupaten</label>
                            <input type="text" class="form-control @error('kabupaten') is-invalid @enderror"
                                id="kabupaten" name="kabupaten" value="{{ old('kabupaten') }}" required>
                            @error('kabupaten')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nama_ayah">Nama Ayah</label>
                            <input type="text" class="form-control @error('nama_ayah') is-invalid @enderror"
                                id="nama_ayah" name="nama_ayah" value="{{ old('nama_ayah') }}" required>
                            @error('nama_ayah')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <label for="nama_ibu">Nama Ibu</label>
                            <input type="text" class="form-control @error('nama_ibu') is-invalid @enderror"
                                id="nama_ibu" name="nama_ibu" value="{{ old('nama_ibu') }}" required>
                            @error('nama_ibu')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="nomor_tlp_ortu">Nomor Tlp Ortu</label>
                            <input type="text" class="form-control @error('nomor_tlp_ortu') is-invalid @enderror"
                                id="nomor_tlp_ortu" name="nomor_tlp_ortu" value="{{ old('nomor_tlp_ortu') }}"
                                maxlength="16" pattern="[0-9]{1,16}" title="Hanya angka dengan maksimal 16 digit"
                                required>
                            @error('nomor_tlp_ortu')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="no_kk">No KK (Kartu Keluarga)</label>
                            <input type="text" class="form-control @error('no_kk') is-invalid @enderror"
                                id="no_kk" name="no_kk" value="{{ old('no_kk') }}" maxlength="16"
                                pattern="[0-9]{1,16}" title="Hanya angka dengan maksimal 16 digit" required>
                            @error('no_kk')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control @error('status') is-invalid @enderror" id="status"
                                name="status" required>
                                <option value="">Pilih Status</option>
                                <option value="Aktif" {{ old('status') == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Tidak Aktif" {{ old('status') == 'Tidak Aktif' ? 'selected' : '' }}>Tidak
                                    Aktif</option>
                            </select>
                            @error('status')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto</label>
                            <input type="file" class="form-control-file @error('foto') is-invalid @enderror" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg" required>
                            @error('foto')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

                    @endsection
