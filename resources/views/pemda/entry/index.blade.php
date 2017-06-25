@extends('app')
<!-- -->

@push('styles')
<style type="text/css">
	.table.table-condensed thead tr th, .table.table-condensed tbody tr td, .table.table-condensed tbody tr td *:not(.dropdown-default) {
    overflow: visible;
    text-overflow: none;
    vertical-align: middle;
    white-space: normal;
}
</style>
@endpush
<!-- -->

@section('pagetitle')
Dinas/Pemda Data
@endsection
<!-- -->

@section('content')

<div class="container-fluid container-fixed-lg bg-white">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="panel-title">pemda</div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-condensed" id="">
                    <thead>
                        <tr>
                            <th class="hidden">id</th>
                            <th class="col-md-2">Jenis</th>
                            <th class="col-md-2">Bidang</th>
                            <th class="col-md-4">Kegiatan</th>
                            <th class="col-md-2">Status</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemdadatas as $row)
                        <tr id="data-row-{{$row->id}}">
                            <td class="hidden">{{$row->id}}</td>
                            <td class="">{{$row->jenis}}</td>
                            <td class="">{{$row->kegiatan->subbidang->bidang->nama}}</td>
                            <td class="">
                            	<p>{{$row->kegiatan->kegiatan}}</p>
                            </td>
                            <td>status</td>
                            <td class="v-align-middle">
                                <a href="{{url('pemda/entry/'.$row->id.'/edit')}}" class="btn btn-primary btn-xs">edit</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
<!-- -->
@push('scripts') @endpush
