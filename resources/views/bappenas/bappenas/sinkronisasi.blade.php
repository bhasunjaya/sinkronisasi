@extends('app')
<!-- -->
@push('styles') @endpush
<!-- -->
@section('pagetitle')
<h3 class="page-header">Detail Verifikasi</h3> @endsection
<!-- -->
@section('content')
<div class="row">
    <div class="col-md-6">

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
    </div>
    <div class="col-md-6">
        @if(session('message'))
        <div class="alert alert-success">
            <strong>{{session('message')}}</strong>
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-body">
                {!! Form::open(['url'=>'bappenas/confirm'])!!}
                {!! Form::hidden('sinkronisasi_id',$sinkronisasi->id) !!}
                <legend>Input Review Data Usulan</legend>
                <div class="form-group">
                    <label for="">Flag Output</label>
                    {!! Form::select('flag',[ "0"=>'Konfirm',"1"=>"Butuh Diskusi"],old('flag',$sinkronisasi->is_flag_bappenas),['class'=>'form-control']
                    ) !!}
                </div>
                <div class="form-group">
                    <label for="">Catatan</label>
                    {!! Form::textarea('note',old('note',$sinkronisasi->bappenas_note),['class'=>'form-control','rows'=>3])!!}
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>

                <a href="{{url('bappenas/pemda?pemda_id='.$sinkronisasi->pemda_id)}}" class="btn btn-link">Kembali Ke Data
                    Review</a>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

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

<div class="row">
    <div class="col-md-4 col-md-offset-4">

    </div>
</div>

@endsection
<!-- -->
@push('scripts')
<script type="text/javascript">
$(function() {
    $("#doSubmit").on('click', function(e) {
        e.preventDefault();
    })
})
</script>
@endpush
