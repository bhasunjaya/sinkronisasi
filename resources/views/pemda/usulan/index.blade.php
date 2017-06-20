@extends('app')
<!-- -->
@push('styles')
<style type="text/css">
.utipe td {
    text-transform: uppercase;
    /*display: inline-block;*/
    letter-spacing: 0.02em;
    font-size: 12px !important;
    font-weight: 600;
}

.ubidang td {
    text-transform: uppercase;
    /*display: inline-block;*/
    letter-spacing: 0.02em;
    font-size: 12px !important;
    font-weight: 600;
}

.usubbidang td {
    text-transform: uppercase;
    letter-spacing: 0.02em;
    font-size: 12px !important;
}

.ue td {
    letter-spacing: 0.02em;
    font-size: 12px !important;
}

.p40 {
    padding-left: 40px !important;
    white-space: normal !important;
}

.p60 {
    padding-left: 60px !important;
    white-space: normal !important;
}

.p80 {
    padding-left: 80px !important;
    white-space: normal !important;
}
table {
    table-layout: fixed;
    word-wrap: break-word;
}
.tdata td {
    white-space: normal !important;
    vertical-align: middle;
}
.w200{
    width: 200px;
}
.w400{
    width: 400px;
}
</style>
@endpush
<!-- -->
@section('pagetitle') @endsection
<!-- -->

@section('content')

<div class="table-responsive">
    <table summary="This table shows how to create responsive tables using Bootstrap's default functionality" class="table table-condensed table-bordered table-hover">
        <thead>

            <tr>
                <th style="width: 50px">id</th>
                <th style="width:400px;">Label</th>
                <th style="width:100px;" class="text-right">Total <br>Output</th>
                <th style="width:100px;" style="width:100px;" class="text-right">Total <br>Dana</th>
                <th style="width:100px;" class="text-right">Output</th>
                <th style="width:400px;" class="">Lokasi</th>
                <th  style="width:100px;" class="">Harga <br>Satuan</th>
                <th  style="width:400px;" class="">Target Pencapaian</th>
                <th  style="width:100px;" class="">Prioritas<br>Kegiatan</th>
                <th   style="width:100px;" class="">pilihan</th>
            </tr>
            <tr>
                <th style="width: 50px">id</th>
                <th style="width:400px;">Label</th>
                <th style="width:100px;" class="text-right">Total <br>Output</th>
                <th style="width:100px;" style="width:100px;" class="text-right">Total <br>Dana</th>
                <th style="width:100px;" class="text-right">Output</th>
                <th style="width:400px;" class="">Lokasi</th>
                <th  style="width:100px;" class="">Harga <br>Satuan</th>
                <th  style="width:400px;" class="">Target Pencapaian</th>
                <th  style="width:100px;" class="">Prioritas<br>Kegiatan</th>
                <th   style="width:100px;" class="">pilihan</th>
            </tr>
        </thead>
        <tbody>
{{--
            @foreach($dd as $tipe=>$r)
            <tr class="utipe">
                <td>&nbsp;</td>
                <td><strong>{{getTipeText($tipe)}}</strong></td>
                <td class="text-right">{{getTipeTotal($r,'cv')}}</td>
                <td class="text-right">{{getTipeTotal($r,'sd')}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>

            @foreach($r as $bidang=>$rBidang)
            <tr class="ubidang">
                <td>&nbsp;</td>
                <td>
                    <div class="p40">{{$bidang}}</div>
                </td>
                <td class="text-right">{{getBidangTotal($rBidang,'cv')}}</td>
                <td class="text-right">{{getBidangTotal($rBidang,'sd')}}</td>
                <td>x</td>
                <td>x</td>
                <td>x</td>
                <td>x</td>
                <td>x</td>
                <td>x</td>
            </tr>

            @foreach($rBidang as $sub=>$rSub) @if($sub != '-')
            <tr class="usubbidang">
                <td>&nbsp;</td>
                <td>
                    <div class="p60">{{str_limit($sub,200)}}</div>
                </td>
                <td class="text-right">{{getBidangSub($rSub,'cv')}}</td>
                <td class="text-right">{{getBidangSub($rSub,'sd')}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endif @foreach($rSub as $e)
            <tr class="ue">
                <td>&nbsp;</td>
                <td>
                    <div class="p80">{{str_limit($e->kegiatan,100)}}</div>
                </td>
                <td class="text-right">{{number_format($e->cv, 2, ',', '.')}}</td>
                <td class="text-right">{{number_format($e->sd, 2, ',', '.')}}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            @endforeach
            <!-- -->
            @endforeach
            <!-- -->
            @endforeach
            <!-- -->

            @endforeach --}}
        </tbody>
    </table>
</div>
@endsection @push('scripts') @endpush
