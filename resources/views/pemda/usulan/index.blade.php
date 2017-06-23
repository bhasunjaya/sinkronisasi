@extends('app')
<!-- -->
@push('styles')
<link rel="stylesheet" media="screen" href="{{asset('b3/js/handsontable/handsontable.full.min.css')}}">
<style type="text/css">
#tabledata {
    width: 100%;
}
</style>
@endpush
<!-- -->

@push('scripts')
<script src="{{asset('b3/js/handsontable/handsontable.full.min.js')}}"></script>
<script src="{{asset('b3/js/pemda-usulan.js')}}"></script>
@endpush
<!-- -->

@section('pagetitle') @endsection
<!-- -->

@section('content')
<div id="tabledata"></div>
@endsection
<!-- -->

@section('content2')

<div class="table-responsive">
    <table class="table table-condensed table-bordered table-hover">
        <thead>

            <tr>
                {{--
                <th style="width: 50px">id</th> --}}
                <th rowspan="2">Label</th>
                <th colspan="2">sementara</th>

                {{-- KL --}}
                <th colspan="3">Penilaian K/L</th>

                {{-- input pemda --}}
                <th colspan="5">Input Pemda</th>

                <th rowspan="2">pilihan</th>
            </tr>
            <tr>
                {{--
                <th style="width: 50px">id</th> --}}
                <th class="text-right">Output</th>
                <th class="">Dana</th>

                {{-- KL --}}
                <th>oup</th>
                <th>Target Pencapaian</th>
                <th>Lokasi</th>

                {{-- input pemda --}}
                <th class="">Output</th>
                <th class="">Satuan</th>
                <th class="">Target Pencapaian</th>
                <th class="">Lokasi</th>
                <th class="">Prioritas
                    <br>Kegiatan</th>

            </tr>
        </thead>
        <tbody>

            <tr class="utipe">
                <td class="col-md-4">a</td>
                <td>b</td>
                <td>a</td>
                <td class="col-md-4">b</td>
                <td>a</td>
                <td>b</td>
                <td>a</td>
                <td>b</td>
                <td>a</td>
                <td>b</td>
                <td>b</td>
                <td>b</td>
            </tr>
            {{-- @foreach($dd as $tipe=>$r)
            <tr class="utipe">
                <td>-</td>
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
                    <div class="p40">{{$rBidang}}</div>
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
@endsection
