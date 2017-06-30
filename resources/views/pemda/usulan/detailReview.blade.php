@extends('app')
<!-- -->
@push('styles') @endpush
<!-- -->
@section('pagetitle')
<div class="row">
    <div class="col-md-8">
        <h3 class="page-header">Detail Usulan</h3>
    </div>
    <div class="col-md-4">
    <div class="text-right">
    <a href="{{url('pemda/review')}}" class="btn btn-link">
        <i class="glyphicon glyphicon-chevron-left"></i>
        kembali
    </a>
    </div>
    </div>
</div>
@endsection
<!-- -->
@section('content')
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="col-md-3">Parameter</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Jenis DAK</td>
            <td>{{$sinkronisasi->jenis}}</td>
        </tr>
        <tr>
            <td>Bidang</td>
            <td>{{$sinkronisasi->kegiatan->subbidang->bidang->nama}}</td>
        </tr>
        <tr>
            <td>Sub-Bidang</td>
            <td>{{$sinkronisasi->kegiatan->subbidang->nama}}</td>
        </tr>

        <tr>
            <td>Output</td>
            <td>{{$sinkronisasi->output}}</td>
        </tr>
        <tr>
            <td>Prioritas Kegiatan</td>
            <td>{{object_get($sinkronisasi,'pemdadata.prioritas')}}</td>
        </tr>
        <tr>
            <td>Catatan K/L</td>
            <td>{{$sinkronisasi->kl_note}}</td>
        </tr>
        <tr>
            <td>Catatan Bappenas</td>
            <td>{{$sinkronisasi->bappenas_note}}</td>
        </tr>
    </tbody>
</table>

<h3>Data Detail Usulan</h3>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>Parameter</th>
            <th class="col-md-4">Penilaian K/L</th>
            <th class="col-md-4">Input Pemda</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Volume</td>
            <td>{{object_get($sinkronisasi,'kldata.volume')}}</td>
            <td>{{object_get($sinkronisasi,'pemdadata.volume')}}</td>
        </tr>
        <tr>
            <td>Satuan</td>
            <td>{{object_get($sinkronisasi,'kldata.satuan')}}</td>
            <td>{{object_get($sinkronisasi,'pemdadata.satuan')}}</td>
        </tr>
        <tr>
            <td>Unit Cost</td>
            <td>{{object_get($sinkronisasi,'kldata.unit_cost')}}</td>
            <td>{{object_get($sinkronisasi,'pemdadata.unit_cost')}}</td>
        </tr>
        <tr>
            <td>Kebutuhan Dana</td>
            <td>{{hitungKebutuhanDana(object_get($sinkronisasi,'kldata.volume'),object_get($sinkronisasi,'kldata.unit_cost'))}}</td>
            <td>{{hitungKebutuhanDana(object_get($sinkronisasi,'pemdadata.volume'),object_get($sinkronisasi,'pemdadata.unit_cost'))}}</td>
        </tr>
        <tr>
            <td>Target Pencapaian</td>
            <td>{{object_get($sinkronisasi,'kldata.target')}}</td>
            <td>{{object_get($sinkronisasi,'pemdadata.target')}}</td>
        </tr>
        <tr>
            <td>Lokasi</td>
            <td>{!! cetakLokasiKL(object_get($sinkronisasi,'kldata.lokasi')) !!}</td>
            <td>
                {!! cetakLokasiPemda(object_get($sinkronisasi,'pemdadata.lokasi')) !!}

            </td>
        </tr>
    </tbody>
</table>

@endsection
<!-- -->
@push('scripts') @endpush
