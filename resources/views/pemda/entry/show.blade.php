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
            kegiatan: {
                subbidang: {
                    bidang: {}
                }
            },
            pemdadata: {
                prioritas: 1,
                volume: 0,
                satuan: 0,
                unit_cost: 0,
                dana: 0,
                target: 0,
            },
            kldata: {
                volume: 0,
                volume: 0,
            }
        },
        lokasi: [],
        newLokasi: '',
        newPrioritas: '',
    },
    created: function() {
        this.loadData();
    },
    computed: {
        pecahLokasi: function() {
            if (this.sinkronisasi.kldata.lokasi) {
                return this.sinkronisasi.kldata.lokasi.split(";")
            }
        },
        dana: function() {
            return this.sinkronisasi.pemdadata.volume * this.sinkronisasi.pemdadata.unit_cost;
        }
    },
    methods: {
        loadData: function() {
            axios.get($("#loadURL").val())
                .then(response => {
                    this.sinkronisasi = response.data;
                    if (this.sinkronisasi.pemdadata) {
                        //     this.pemdadata = response.data.pemdadata;
                        //     // console.log();
                        //     //     this.prioritas = response.data.pemdadata.prioritas;
                            this.lokasi = JSON.parse(this.sinkronisasi.pemdadata.lokasi);
                    } else {
                        if (this.sinkronisasi.pemdadata === null) {
                            var v = {
                                prioritas: 1,
                                volume: parseFloat(this.sinkronisasi.kldata.volume),
                                satuan: this.sinkronisasi.kldata.satuan,
                                unit_cost: parseFloat(this.sinkronisasi.kldata.unit_cost),
                                dana: parseFloat(this.sinkronisasi.kldata.dana),
                                target: this.sinkronisasi.kldata.target
                            };
                            this.sinkronisasi.pemdadata = v;
                            var lokasis = this.sinkronisasi.kldata.lokasi.split(";");
                            var i;
                            for (i = 0; i < lokasis.length; i++) {
                                var alok = {
                                    lokasi: lokasis[i],
                                    prioritas: i + 1
                                };
                                this.lokasi.push(alok);
                            }
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
                pemda_id: this.sinkronisasi.kldata.pemda_id,
                bidang_id: this.sinkronisasi.kldata.bidang_id,
                subbidang_id: this.sinkronisasi.kldata.subbidang_id,
                kegiatan_id: this.sinkronisasi.kldata.kegiatan_id,
                jenis: this.sinkronisasi.kldata.jenis,
                volume: this.sinkronisasi.pemdadata.volume,
                satuan: this.sinkronisasi.pemdadata.satuan,
                unit_cost: this.sinkronisasi.pemdadata.unit_cost,
                dana: this.dana,
                target: this.sinkronisasi.pemdadata.target,
                prioritas: this.sinkronisasi.pemdadata.prioritas,
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

<table class="table table-bordered table-hover" v-if="sinkronisasi">
    <thead>
        <tr>
            <th class="col-md-3">Parameter</th>
            <th>Data</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Jenis DAK</td>
            <td>
                <span v-if="sinkronisasi">@{{sinkronisasi.jenis}}</span>
            </td>
        </tr>
        <tr>
            <td>Bidang</td>
            <td>
                <span v-if="sinkronisasi.kegiatan.subbidang.bidang.nama">@{{sinkronisasi.kegiatan.subbidang.bidang.nama}}</span>
            </td>
        </tr>
        <tr>
            <td>Sub-Bidang</td>
            <td><span v-if="sinkronisasi.kegiatan.subbidang.nama">@{{sinkronisasi.kegiatan.subbidang.nama}}</span></td>
        </tr>

        <tr>
            <td>Output</td>
            <td>@{{sinkronisasi.output}}</td>
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
                <input type="text" class="form-control" v-model="sinkronisasi.pemdadata.prioritas">
            </td>
        </tr>
        <tr>
            <td>Volume</td>
            <td>
                <label>@{{sinkronisasi.kldata.volume}}</label>
            </td>
            <td>
                <input type="text" class="form-control" v-model="sinkronisasi.pemdadata.volume">
            </td>
        </tr>
        <tr>
            <td>Satuan</td>
            <td>@{{sinkronisasi.kldata.satuan}}</td>
            <td>
                <input type="text" class="form-control" v-model="sinkronisasi.pemdadata.satuan">
            </td>
        </tr>
        <tr>
            <td>Unit Cost</td>
            <td>@{{sinkronisasi.kldata.unit_cost}}</td>
            <td>
                <input type="text" class="form-control" v-model="sinkronisasi.pemdadata.unit_cost">
            </td>
        </tr>
        <tr>
            <td>Kebutuhan Dana</td>
            <td>N/A</td>
            <td>
                <input type="text" class="form-control" v-model="dana">
            </td>
        </tr>
        <tr>
            <td>Target Pencapaian</td>
            <td>@{{sinkronisasi.kldata.target}}</td>
            <td>
                <textarea name="" id="input" class="form-control" rows="3" v-model="sinkronisasi.pemdadata.target"></textarea>
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
