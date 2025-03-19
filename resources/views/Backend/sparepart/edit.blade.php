@extends('backend.layouts.master')

@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card shadow-lg border-0">
                    <div style="background-color: #111c43; color: white;"
                        class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="mb-0"><i class="fas fa-tools"></i> Edit Sparepart</h3>
                        <div class="ml-auto">
                            <a href="{{ route('sparepart.index') }}"
                                class="btn btn-outline-light btn-sm px-3 py-2 rounded-pill shadow-sm">
                                <i class="fas fa-arrow-left"></i> Back
                            </a>
                        </div>
                    </div>
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi Kesalahan!</strong> Periksa kembali inputan Anda.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                    <div class="card-body">
                        <form action="{{ route('sparepart.update', $sparepart->kode) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="kode"><i class="fas fa-barcode"></i> Kode Sparepart</label>
                                <input type="text" name="kode" class="form-control" id="kode"
                                    value="{{ $sparepart->kode }}" required>
                            </div>

                            <div class="form-group">
                                <label for="nama"><i class="fas fa-tools"></i> Nama Sparepart</label>
                                <input type="text" name="nama" class="form-control" id="nama"
                                    value="{{ $sparepart->nama }}" required>
                            </div>

                            <div class="form-group">
                                <label for="jumlah"><i class="fas fa-sort-numeric-up"></i> Jumlah</label>
                                <input type="number" name="jumlah" class="form-control" id="jumlah"
                                    value="{{ $sparepart->jumlah }}" required>
                            </div>

                            <div class="form-group">
                                <label for="harga"><i class="fas fa-dollar-sign"></i> Harga</label>
                                <input type="number" name="harga" class="form-control" id="harga"
                                    value="{{ $sparepart->harga }}" required>
                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-success"><i class="fas fa-save"></i> Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
