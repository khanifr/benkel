@extends('backend.layouts.master')

@section('content')
<div class="container">
    <h1>Kendaraan Details</h1>
    <div>
        <strong>No. Polisi: </strong>{{ $kendaraan->nopol }}
    </div>
    <div>
        <strong>Merek: </strong>{{ $kendaraan->merek }}
    </div>
    <div>
        <strong>Tipe: </strong>{{ $kendaraan->tipe }}
    </div>
    <div>
        <strong>Transmisi: </strong>{{ $kendaraan->transmisi }}
    </div>
    <div>
        <strong>Kapasitas: </strong>{{ $kendaraan->kapasitas }}
    </div>
    <div>
        <strong>Tahun: </strong>{{ $kendaraan->tahun }}
    </div>
    <div>
        <strong>Pelanggan: </strong>{{ $kendaraan->pelanggan->nama }}
    </div>
    <a href="{{ route('kendaraan.index') }}" class="btn btn-secondary">Back to List</a>
</div>
@endsection
