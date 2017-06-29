@extends('app')
<!-- -->

@push('styles')

<link rel="stylesheet" type="text/css" href="{{asset('flat/css/dataTables.bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('flat/css/select2.min.css')}}"> @endpush
<!-- -->

@section('pagetitle')<h3 class="page-header">Review: {{$pemda->nama}}</h3>
@endsection
<!-- -->

@section('content')
<div class="panel panel-default">
    <div class="panel-heading"><strong>Pilih Pemda</strong></div>
    <div class="panel-body">
        {!! Form::open(['url'=>'bappenas/pemda']) !!}
        <div class="form-group">
            <label for="">Pilih Daerah</label>

            {!! Form::select('pemda_id',\App\Pemda::pluck('nama','id'),$pemda->id,['class'=>'form-control s2'])!!}

        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        {!! Form::close() !!}
    </div>
</div>

<table class="table table-hover table-bordered table-condensed" id="datatables">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th colspan="4">DATA AWAL</th>
            <th colspan="3">DATA K/L</th>
            <th colspan="4">ENTRY INPUT PEMDA</th>
        </tr>
        <tr>
            <th>Pilihan</th>
            <th>Status</th>
            <th>Jenis</th>
            <th style="min-width: 450px">Kegiatan</th>

            <th>Output</th>
            <th>Dana</th>

            <th>Output</th>
            <th>Target</th>
            <th>Lokasi</th>

            <th>Output</th>
            <th>Kebutuhan Dana</th>
            <th>Target</th>
            <th>Lokasi</th>

        </tr>
    </thead>
    <tbody>
        @foreach($sinkronisasis as $row)
        <tr id="data-row-{{$row->id}}">

            <td class="v-align-middle">
                <a href="{{url('bappenas/sinkronisasi/'.$row->id)}}">detail</a>
            </td>

            <td>{!! getFlagSinkronisasi($row) !!}</td>
            <td class="">{{$row->jenis}}</td>
            <td style="width: 400px">
                <strong>{{$row->kegiatan->subbidang->bidang->nama}} / {{$row->kegiatan->subbidang->nama}}</strong>
                <p>{{$row->kegiatan->kegiatan}}</p>
            </td>
            <td>{{$row->output}}</td>
            <td>{{$row->dana}}</td>

            <td>{{object_get($row->kldata,'volume')}}</td>
            <td>{{object_get($row->kldata,'target')}}</td>
            <td>{{object_get($row->kldata,'lokasi')}}</td>

            <td>{{object_get($row->pemdadata,'volume')}}</td>
            <td>{{object_get($row->pemdadata,'volume')*object_get($row->pemdadata,'unit_cost')}}</td>
            <td>{{object_get($row->pemdadata,'target')}}</td>
            <td>{{object_get($row->pemdadata,'lokasi')}}</td>

        </tr>
        @endforeach
    </tbody>
</table>
@endsection
<!-- -->
@push('scripts')
<script type="text/javascript" src="{{asset('flat//js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('flat//js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('flat/js/select2.min.js')}}"></script>

<script type="text/javascript">
$(document).ready(function() {
    $('#datatables').DataTable({
        "scrollY": 350,
        "scrollX": true,
        "paging": false
    });
    $(".s2").select2();
});
</script>
@endpush
