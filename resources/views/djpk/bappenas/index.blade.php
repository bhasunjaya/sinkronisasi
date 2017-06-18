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
<h1>Data Master Bappenas</h1> @endsection
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
            <div class="panel-title">Pages condensed Table</div>
            <div class="btn-group pull-right m-b-10">
                <a href="{{url('djpk/bappenas/create')}}" class="btn btn-primary">Tambah Data</a>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-hover table-condensed" id="tableWithDynamicRows">
                    <thead>
                        <tr>
                            <th class="">Nama</th>
                            <th>Pilihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($bappenas as $row)
                        <tr id="data-row-{{$row->id}}">
                            <td class="v-align-middle">{{$row->nama}}</td>
                            <td class="v-align-middle">
                                <a href="{{url('djpk/bappenas/'.$row->id.'/edit')}}" class="btn btn-primary btn-xs">edit</a>
                                <button class="btn btn-danger btn-xs btn-del" data-url="{{url('djpk/bappenas/'.$row->id)}}">delete</button>
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
