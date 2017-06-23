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
<h1>Upload Excell Dari K/L </h1> @endsection @section('content')
<div class="container-fluid container-fixed-lg bg-white">
    <div class="row">
        <div class="col-sm-5">

            <div class="panel panel-transparent">
                <div class="panel-heading">
                    <div class="panel-title">Upload File Excell </div>
                </div>
                <div class="panel-body">
                    <h3>Anda bisa mengupload file excell disini</h3>
                    <p>Despite the UI, We thought of the User experience, With attached From Layouts you can simply categories Important fields and prioritize them.</p>
                </div>
            </div>

        </div>
        <div class="col-sm-7">

            <div class="panel panel-transparent">
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
                    <p>Basic Information</p>
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
                    <p class="m-t-10">Upload File Excell</p>
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
    </div>
</div>
@endsection
