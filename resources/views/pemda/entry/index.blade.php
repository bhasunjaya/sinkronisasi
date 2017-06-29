@extends('app')
<!-- -->

@push('styles')

<link rel="stylesheet" type="text/css" href="{{asset('flat/css/dataTables.bootstrap.min.css')}}">

<style type="text/css">
/*
#tabledata td {
    min-width: 100px;
}

table#tabledata thead {
    border-top: none;
    border-bottom: none;
    background-color: #FFF;
}

.table-responsive {
    height: 400px !important;
    overflow: scroll;
}*/
</style>
@endpush
<!-- -->

@section('pagetitle')
<h1 class="page-header">Entry Data Dinas/Pemda</h1> @endsection
<!-- -->

@section('content')
<!-- <div class="table-responsive"> -->
<table class="table table-hover table-bordered table-condensed" id="datatables">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th colspan="4">&nbsp;</th>
            <th colspan="3">DATA AWAL</th>
            <th colspan="4">ENTRY INPUT PEMDA</th>
        </tr>
        <tr>
            <th>Status Entry</th>
            <th style="width: 100px">Jenis</th>
            <th style="min-width: 450px">Kegiatan</th>

            <th style="width: 100px">Output</th>
            <th style="width: 100px">Dana</th>

            <th style="width: 100px">Output</th>
            <th style="min-width: 400px">Target</th>
            <th style="min-width: 400px">Lokasi</th>

            <th style="width: 100px">Output</th>
            <th style="width: 100px">Kebutuhan Dana</th>
            <th style="min-width: 400px">Target</th>
            <th style="min-width: 400px">Lokasi</th>

        </tr>
    </thead>
    <tbody>
        @foreach($sinkronisasis as $row)
        <tr id="data-row-{{$row->id}}">

            <td class="v-align-middle">
                @if(object_get($row,'kldata',false)) @if($row->is_entry_pemda)
                <a href="{{url('pemda/entry/'.$row->id)}}">Rubah Data</a> @else
                <a href="{{url('pemda/entry/'.$row->id)}}">Input Data</a> @endif @endif
            </td>
            <td class="">{{$row->jenis}}</td>
            <td class="">
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
<!-- </div> -->
@endsection
<!-- -->
@push('scripts')
<script type="text/javascript" src="{{asset('flat//js/jquery.dataTables.min.js')}}"></script>
<script type="text/javascript" src="{{asset('flat//js/dataTables.bootstrap.min.js')}}"></script>
<script type="text/javascript">
$(document).ready(function() {
    $('#datatables').DataTable({
        "scrollY": 500,
        "scrollX": true,
        "paging": false
    });
});
</script>
@endpush
