@extends('app')

<!-- start scripts -->
@push('scripts')
<script src="{{asset('b3/js/jquery.dataTables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('b3/js/dataTables.tableTools.min.js')}}" type="text/javascript"></script>
<script src="{{asset('b3/js/dataTables.bootstrap.js')}}" type="text/javascript"></script>
<script src="{{asset('b3/js/jquery-datatable-bootstrap.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('b3/js/datatables.responsive.js')}}"></script>
<script type="text/javascript" src="{{asset('b3/js/lodash.min.js')}}"></script>
<script src="{{asset('b3/js/datatables.js')}}" type="text/javascript"></script>
@endpush
<!-- end scripts -->

@push('styles')
<link href="{{asset('b3/css/dataTables.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('b3/css/dataTables.fixedColumns.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('b3/css/datatables.responsive.css')}}" rel="stylesheet" type="text/css" media="screen" /> @endpush
<!-- end style -->

@section('pagetitle')
<h1>Data Master Pemda</h1> @endsection
<!-- end pagetitle -->

@section('content')
<div class="container-fluid container-fixed-lg bg-white">
    @if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    <div class="panel panel-transparent">
        <div class="panel-heading">
            <div class="panel-title">Semua data pemda</div>
            <div class="btn-group pull-right m-b-10">
                <a href="{{url('djpk/pemda/create')}}" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
            <input type="text" id="search-table" class="form-control pull-right" placeholder="Search">
                <table class="table table-hover table-condensed" id="tableWithSearch">
                    <thead>
                        <tr>
                            <th class="hidden">id</th>
                            <th style="width:5%">Prov</th>
                            <th style="width:5%">Kab</th>
                            <th class="">Nama</th>
                            <th class="">ID PEMDA</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemdas as $row)
                        <tr id="data-row-{{$row->id}}">
                            <td class="hidden">{{$row->id}}</td>
                            <td class="">{{$row->prov}}</td>
                            <td class="">{{$row->kab}}</td>
                            <td class="">{{$row->nama}}</td>
                            <td class="">{{$row->idpemda}}</td>
                            <td class="v-align-middle">
                                <a href="{{url('djpk/pemda/'.$row->id.'/edit')}}" class="btn btn-primary btn-xs">edit</a>
                                <button class="btn btn-danger btn-xs btn-del" data-url="{{url('djpk/pemda/'.$row->id)}}">delete</button>
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
<!-- end content -->
