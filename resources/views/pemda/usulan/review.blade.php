@extends('app')
<!-- -->

@push('styles')

<link rel="stylesheet" type="text/css" href="{{asset('flat/css/dataTables.bootstrap.min.css')}}">

<style type="text/css">
#datatables td {
    min-width: 100px;
}


</style>
@endpush
<!-- -->

@section('pagetitle')
<h3 class="page-header">Entry Data Dinas/Pemda</h3> @endsection
<!-- -->

@section('content')
<!-- <div class="table-responsive"> -->
<table class="table table-hover table-bordered table-condensed" id="datatables">
    <thead>
        <tr>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th colspan="4">&nbsp;</th>
            <th colspan="3">DATA AWAL</th>
            <th colspan="4">ENTRY INPUT PEMDA</th>
        </tr>
        <tr>
            <th>Pilihan</th>
            <th>Status</th>
            <th>Jenis</th>
            <th style="min-width: 450px">Kegiatan</th>

            <th >Output</th>
            <th >Dana</th>

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
                <a href="{{url('pemda/review/'.$row->id)}}">detail</a>
            </td>

            <td class="">
               {!! getFlagSinkronisasi($row) !!}
                <!-- <div class="text-center">
                    <span class="label label-success">k/l</span>
                    <span class="label label-danger">bpns</span>
                </div> -->
            </td>
            <td class="">{{$row->jenis}}</td>
            <td class="">
                <strong>{{$row->kegiatan->subbidang->bidang->nama}} / {{$row->kegiatan->subbidang->nama}}</strong>
                <p>{{$row->kegiatan->kegiatan}}</p>
            </td>
            <td class="text-right">{{angka($row->output)}}</td>
            <td class="text-right">{{angka($row->dana)}}</td>

            <td class="text-right">{{angka(object_get($row->kldata,'volume'))}}</td>
            <td>{{object_get($row->kldata,'target')}}</td>
            <td>{{object_get($row->kldata,'lokasi')}}</td>

            <td class="text-right">{{angka(object_get($row->pemdadata,'volume'))}}</td>
            <td class="text-right">{{angka(object_get($row->pemdadata,'volume')*object_get($row->pemdadata,'unit_cost'))}}</td>
            <td>{{object_get($row->pemdadata,'target')}}</td>
            <td>{!! renderLokasiFromPemdaData(object_get($row->pemdadata,'lokasi'))!!}</td>

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
        "scrollY": 350,
        "scrollX": true,
        "paging": false
    });
});
</script>
@endpush
