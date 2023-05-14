@extends('layouts2.template')
@section('content')
<div class="midde_cont">
    <div class="container-fluid">
        <div class="row column_title">
            <div class="col-md-12">
                <div class="page_title">
                    <center>
                        <h2>Hasil Perhitungan</h2>
                        <p>Dengan menggunakan metode AHP dan TOPSIS sebelumnya, maka didapatkan hasil berupa perangkingan nilai siswa dari yang terbesar ke terkecil
                        </p>
                    </center>
                </div>
            </div>
        </div>

        <div class="dark_bg full margin_bottom_30">
            <div class="dark_bg full margin_bottom_30">
                <div class="graph_head">
                    <div class="col-md-12">
                        <div class="card card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h3 style="margin: 0px">Keputusan (Perangkingan)</h3>

                                    @php

                                    $kolom = $topsis;
                                    $json_relatif = json_decode( $kolom->jarak_relatif );

                                    @endphp

                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Nama Siswa</th>
                                                <th>Kelas</th>
                                                <th>Hasil Perhitungan</th>
                                                <th>Rangking</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ( $json_relatif AS $no => $isi )
                                            <tr>
                                                <td>{{ $isi->nama}}</td>
                                                <td>{{ $isi->id_kelas_siswa}}</td>
                                                <td>{{ number_format($isi->hasilJarak, 2)}}</td>
                                                <td>{{ $no + 1}}</td>

                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="col-md-2">
                        <a class="btn btn-warning" href="{{ url('/hasilPerhitungan') }}"><i class="fa fa-backward"></i> Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection