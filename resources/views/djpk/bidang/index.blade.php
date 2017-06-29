@extends('app')

<!-- start scripts -->
@push('scripts') @endpush
<!-- end scripts -->

@push('styles')
<!-- end style -->

@section('pagetitle')
<h1 class="page-header">Data Master Bidang</h1> @endsection
<!-- end pagetitle -->

@section('content') @if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
<a href="{{url('djpk/bidang/create')}}" class="btn btn-primary">Tambah Data</a>

<table class="table table-hover table-condensed table-bordered" id="">
    <thead>
        <tr>
            <th class="">Nama</th>
            <th>Pilihan</th>
        </tr>
    </thead>
    <tbody>
        @foreach($bidangs as $row)
        <tr id="data-row-{{$row->id}}">
            <td class="v-align-middle">{{$row->nama}}</td>
            <td class="v-align-middle">
                <a href="{{url('djpk/bidang/'.$row->id.'/edit')}}" class="btn btn-primary btn-xs">edit</a>
                <button class="btn btn-danger btn-xs btn-del" data-url="{{url('djpk/bidang/'.$row->id)}}">delete</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection
<!-- end content -->
