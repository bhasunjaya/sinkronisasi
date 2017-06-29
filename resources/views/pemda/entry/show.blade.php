@extends('app')
<!-- -->

@push('scripts')
<script src="{{asset('flat/js/vue.min.js')}}"></script>
<script src="{{asset('flat/js/axios.min.js')}}"></script>
<script src="{{asset('flat/js/toastr.min.js')}}"></script>

<script type="text/javascript">
var app = new Vue({
    el: '#app',
    data: {
        errors: [],
        sinkronisasi: {
            jenis: '',
            dana: '',
            output: '',
            kegiatan: {
                kegiatan:'',
                subbidang: {
                    nama: '',
                    bidang: {
                        nama: ''
                    }
                }
            },
        },
        kldata: {
           volume:0,
           satuan:'',
           unit_cost:'',
           target:'',
        },
        pemdadata: {
            prioritas:0,
            volume: null,
            satuan: null,
            unit_cost: null,
            dana: null,
            target: null,
            lokasi: null,
        },
        // // dana:0,
        // usulan: [],
        lokasi: [],
        newLokasi: '',
        newPrioritas: '',
    },
    created: function() {
        this.loadData();
    },
    computed: {
        pecahLokasi: function() {
            if (this.kldata.lokasi) {
                return this.kldata.lokasi.split(";")
            }
        },
        dana:function(){
            return this.pemdadata.volume*this.pemdadata.unit_cost;
        }
    },
    methods: {
        loadData: function() {
            axios.get($("#loadURL").val())
                .then(response => {
                    // this.$set(this.data, 'sinkronisasi', response.data.sinkronisasi)
                    // console.log(response.data.sinkronisasi);
                    this.sinkronisasi = response.data.sinkronisasi;
                    this.kldata = response.data.kldata;
                    // this.usulan = response.data.usulan;
                    // console.log(response.data.pemdadata);
                    if (response.data.pemdadata) {
                        this.pemdadata = response.data.pemdadata;
                        // console.log();
                    //     this.prioritas = response.data.pemdadata.prioritas;
                        this.lokasi = JSON.parse(this.pemdadata.lokasi);
                    } else {
                        this.pemdadata.volume = parseFloat(response.data.kldata.volume)
                        this.pemdadata.satuan = response.data.kldata.satuan
                        this.pemdadata.unit_cost = parseFloat(response.data.kldata.unit_cost)
                        this.pemdadata.dana = parseFloat(response.data.kldata.dana)
                        this.pemdadata.target = response.data.kldata.target
                        var lokasis = response.data.kldata.lokasi.split(";");
                        var i;
                        for (i = 0; i < lokasis.length; i++) {
                            var alok = {
                                lokasi: lokasis[i],
                                prioritas: i + 1
                            };
                            this.lokasi.push(alok);
                        }
                    }
                })
        },
        kurangiLokasi: function(index) {
            this.lokasi.splice(index, 1);
        },
        tambahLokasi: function() {
            this.lokasi.push({
                lokasi: this.newLokasi,
                prioritas: this.newPrioritas,
            });
            this.newLokasi = '';
            this.newPrioritas = '';
        },
        simpan: function(e) {
            let data = {
                sinkronisasi_id: this.sinkronisasi.id,
                pemda_id: this.kldata.pemda_id,
                bidang_id: this.kldata.bidang_id,
                subbidang_id: this.kldata.subbidang_id,
                kegiatan_id: this.kldata.kegiatan_id,
                jenis: this.kldata.jenis,
                volume: this.pemdadata.volume,
                satuan: this.pemdadata.satuan,
                unit_cost: this.pemdadata.unit_cost,
                dana: this.dana,
                target: this.pemdadata.target,
                prioritas: this.pemdadata.prioritas,
                lokasi: this.lokasi
            }
            console.log(data);
            // return ;
            axios.put($("#submitURL").val(), data)
                .then(response => {
                    toastr.info('data telah tersimpan')
                })
                .catch(error => {
                    if (error.response.status == 422) {
                        for (var key in error.response.data) {
                            // skip loop if the property is from prototype
                            if (!error.response.data.hasOwnProperty(key)) continue;
                            var obj = error.response.data[key];
                            for (var prop in obj) {
                                // skip loop if the property is from prototype
                                if (!obj.hasOwnProperty(prop)) continue;
                                toastr.error(obj[prop]);
                            }
                        }
                    }
                })
        }
    }
})
</script>

@endpush
<!-- -->

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('flat/css/toastr.min.css')}}"> @endpush
<!-- -->

@section('pagetitle')
<h1 class="page-header">Pemda - Entry Data - Detail</h1> @endsection
<!-- -->

@section('content')
<input type="hidden" id="loadURL" value="{{url('pemda/entry/get-data-entry/'.$id)}}">
<input type="hidden" id="submitURL" value="{{url('pemda/entry/'.$id)}}">

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="col-md-3">Parameter</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Jenis DAK</td>
            <td>@{{sinkronisasi.jenis}}</td>
        </tr>
        <tr>
            <td>Bidang</td>
            <td>@{{sinkronisasi.kegiatan.subbidang.bidang.nama}}</td>
        </tr>
        <tr>
                <td>Sub-Bidang</td>
                <td>@{{sinkronisasi.kegiatan.subbidang.nama}}</td>
            </tr>

        <tr>
            <td>Output</td>
            <td>@{{sinkronisasi.output}}</td>
        </tr>

        <tr>
            <td>Prioritas Kegiatan</td>
            <td>##</td>
        </tr>
    </tbody>
</table>

<h2 class="page-header">Data K/L</h2>
<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th class="col-md-4">Parameter</th>
            <th class="col-md-2">Penilaian K/L</th>
            <th class="col-md-6">Input Pemda</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Prioritas Kegiatan</td>
            <td>N/A</td>
            <td>
                <input type="text" class="form-control" v-model="pemdadata.prioritas">
            </td>
        </tr>
        <tr>
            <td>Volume</td>
            <td>@{{kldata.volume}}</td>
            <td>
                <input type="text" class="form-control" v-model="pemdadata.volume">
            </td>
        </tr>
        <tr>
            <td>Satuan</td>
            <td>@{{kldata.satuan}}</td>
            <td>
                <input type="text" class="form-control" v-model="pemdadata.satuan">
            </td>
        </tr>
        <tr>
            <td>Unit Cost</td>
            <td>@{{kldata.unit_cost}}</td>
            <td>
                <input type="text" class="form-control" v-model="pemdadata.unit_cost">
            </td>
        </tr>
        <tr>
            <td>Kebutuhan Dana</td>
            <td>xxxx</td>
            <td>
                <input type="text" class="form-control" v-model="dana">
            </td>
        </tr>
        <tr>
            <td>Target Pencapaian</td>
            <td>@{{kldata.target}}</td>
            <td>
                <textarea name="" id="input" class="form-control" rows="3" v-model="pemdadata.target"></textarea>
            </td>
        </tr>
        <tr>
            <td>Lokasi</td>
            <td>
                <ol>
                    <li v-for="lok in pecahLokasi">@{{lok}}</li>
                </ol>

            </td>
            <td>

                <div v-for="(lok,index) in lokasi">
                    <div class="form-inline">
                        <div class="form-group">
                            <input type="text" class="form-control" v-model="lok.lokasi" />
                        </div>
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control col-md-1" v-model="lok.prioritas" />
                                <div class="btn btn-text input-group-addon" v-on:click="kurangiLokasi(index)">-</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-inline">
                    <div class="form-group">
                        <input v-model="newLokasi" type="text" class="form-control" />
                    </div>
                    <div class="form-group">
                        <div class="input-group">
                            <input v-model="newPrioritas" type="text" class="form-control col-md-1" placeholder="prioritas" />
                            <div class="btn btn-xs btn-info input-group-addon" v-on:click="tambahLokasi">tambah</div>
                        </div>
                    </div>
                </div>

            </td>
        </tr>
    </tbody>
</table>
<div class="row">
    <div class="col-md-12">
        <div class="text-center">
            <button type="button" v-on:click="simpan()" class="btn btn-info">Simpan Data</button>
            <a href="{{url('pemda/entry')}}" class="btn btn-default">Kembali ke Data Entry</a>
        </div>
    </div>
</div>
@endsection
