@extends('app')

<!-- -->
@push('styles')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" />
@endpush
<!-- -->
@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("#ddSubbidang").on('change',function(e){
            console.log(this.value);
            $.get('/djpk/list-kegiatan/'+this.value,function(r){
                console.log(r);
            })
        })
    })

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
                    <form id="form-project" role="form" autocomplete="off" novalidate="novalidate">
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

{{--                             <div class="form-group form-group-default required" aria-required="true">
                                <label>Jenis Kegiatan</label>
                                {!! Form::select('jenis',getSelectBidang(),old('jenis'),['class'=>'form-control']) !!}
                            </div> --}}
                        </div>
                        <p class="m-t-10">Upload File Excell</p>
                        <div class="form-group-attached">
                            <div class="form-group form-group-default">
                                <label>Investor <i class="fa fa-info text-complete m-l-5"></i></label>
                                {!! Form::file('file',['class'=>'form-control']) !!}
                            </div>
                        </div>
                        <br>
                        <button class="btn btn-success" type="submit">Submit</button>
                        <button class="btn btn-default"><i class="pg-close"></i> Clear</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
