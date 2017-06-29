@extends('app')

<!-- -->
@push('styles') @endpush
<!-- -->
@push('scripts')
<script type="text/javascript">
$(document).ready(function() {
    $("#ddSubbidang").on('change', function(e) {
        $.get('/djpk/list-kegiatan/' + this.value, function(r) {
            $("#kegiatan_id option").remove();
            $.each(r, function() {
                $("#kegiatan_id").append('<option value="' + this.id + '">' + this.kegiatan + '</option>')
            })
        })
    })
});
</script>
@endpush

<!-- -->
@section('pagetitle')
<h3 class="page-header">Upload Excell Dari K/L </h3> @endsection
<!-- -->

@section('content')
<div class="row">

    <div class="col-sm-6">
        @if(session('message'))
        <div class="alert alert-info">
            <strong>{{session('message')}}!</strong>
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">
                <strong>Upload File Excell</strong>
            </div>
            <div class="panel-body">
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <button class="close" data-dismiss="alert"></button>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif {!! Form::open(['url'=>'djpk/document','files'=>true,"method"=>"post"])!!}
                <div class="form-group-attached">
                    <div class="form-group form-group-default required" aria-required="true">
                        <label>Jenis DAK</label>
                        {!! Form::select('jenis',getSelectDak(),old('jenis'),['class'=>'form-control','placeholder' => '-- Pilih Jenis DAK --']) !!}
                    </div>
                    <div class="row clearfix">
                        <div class="col-sm-6">
                            <div class="form-group form-group-default">
                                <label>Bidang/Sub-Bidang</label>
                                {!! Form::select('subbidang_id',getSelectBidang(),old('jenis'),['class'=>'form-control',"placeholder"=>'--- PILIH BIDANG/SUB-BIDANG ---',"id"=>"ddSubbidang"]) !!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group form-group-default required" aria-required="true">
                        <label>Jenis Kegiatan</label>
                        {!! Form::select('kegiatan_id',[],old('kegiatan_id'),['class'=>'form-control','id'=>'kegiatan_id']) !!}
                    </div>
                </div>
                <div class="form-group-attached">
                    <div class="form-group form-group-default">
                        <label>Excell file</label>
                        {!! Form::file('file',['class'=>'form-control']) !!}
                    </div>
                </div>
                <br>
                <button class="btn btn-success" type="submit">Upload Files</button>
                {!! Form::close()!!}
            </div>
        </div>

    </div>
    <div class="col-sm-6">
        <div class="panel panel-info">
            <div class="panel-heading"><strong>Anda Bisa Mendowload Format File excel disini</strong></div>
            <div class="panel-body">
                <a href="{{url('djpk/document/download')}}" type="button" class="btn btn-info">Download Template</a>
            </div>
        </div>

        @if($documents)
        <div class="panel panel-warning">
            <div class="panel-heading"><strong>Dokumen yang belum terproses</strong></div>
            <table class="table table-hover table-striped table-bordered table-condensed">

                <tbody>
                    @foreach($documents as $doc)
                    <tr>
                        <td>
                            <p>
                            <strong>{{$doc->subbidang->bidang->nama}} / {{$doc->subbidang->nama}}</strong>
                            <br><small>{{$doc->nama}}</small>
                            </p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>
@endsection
